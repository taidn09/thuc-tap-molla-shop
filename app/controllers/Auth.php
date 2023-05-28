<?php
require 'core/googleApi/vendor/autoload.php';



require_once 'core/Facebook/autoload.php'; // change path as needed

class Auth extends Controller
{
    public $data = [];
    public $model = null;
    public $client = null;
    public $handler = null;
    public $fb = null;
    public function __construct()
    {
        $this->model = new UserModel();
        $this->fb = new \Facebook\Facebook([
            'app_id' => '706310547919887',
            'app_secret' => '04735092b41290def9ae210dfef1f6b1',
            'default_graph_version' => 'v17.0',
        ]);
        $this->handler = $this->fb->getRedirectLoginHelper();
    }

    public function index()
    {
        if (!empty($_SESSION['user'])) {
            echo header("location: /");
        }

        // handle login with google
        $this->client = new Google_Client();
        $this->client->setClientId('121314066388-5372ggqhu57tvmuptjv1kdr4kbir1t72.apps.googleusercontent.com');
        $this->client->setClientSecret('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');
        $this->client->setRedirectUri('https://mvc.com/auth');
        $this->client->addScope('https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email');
        if (isset($_GET['code'])) {
            $token = $this->client->fetchAccessTokenWithAuthCode($_GET['code']);
            if (empty($token['error'])) {
                $this->client->setAccessToken($token['access_token']);
                // get profile info
                $google_oauth = new Google_Service_Oauth2($this->client);
                $google_account_info = $google_oauth->userinfo->get();
                $check = $this->model->checkEmailExisted($google_account_info->email);
                if (empty($check)) {
                    $this->model->register($google_account_info->email, $google_account_info->id);
                    $user = $this->model->login($google_account_info->email,  $google_account_info->id);
                    $id = $user['userId'];
                    $this->model->updateUser($id, $google_account_info->familyName, $google_account_info->givenName);
                    echo '<script>window.location = "/"</script>';
                    die;
                }
                $user = $this->model->login($google_account_info->email,  $google_account_info->id);
                $_SESSION['user'] = $user;
                echo '<script>window.location = "/"</script>';
                die;
            }
        }
        // handle login with facebook
        $redirectTo = 'https://mvc.com/auth/fbAuth';
        $arr = ['email'];
        $fullUrl = $this->handler->getLoginUrl($redirectTo, $arr);

        // load ui
        $this->data['title'] = 'Đăng nhập / Đăng ký';
        $this->data['content'] = 'client/pages/auth';
        $this->data['subcontent']['googleLoginLink'] = $this->client->createAuthUrl();
        $this->data['subcontent']['fbLoginLink'] = $fullUrl;
        $this->render('layouts/client', $this->data);
    }
    public function fbAuth()
    {
        try {
            $accessToken = $this->handler->getAccessToken();
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (!isset($accessToken)) {
            if ($this->handler->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $this->handler->getError() . "\n";
                echo "Error Code: " . $this->handler->getErrorCode() . "\n";
                echo "Error Reason: " . $this->handler->getErrorReason() . "\n";
                echo "Error Description: " . $this->handler->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }

        // Logged in
        $response = $this->fb->get('/me?fields=email,picture', $accessToken->getValue());
        $me = $response->getGraphUser();
        $email = $me->getEmail();
        $pictureUrl = $me->getPicture()->getUrl();
        $nameArr = explode(' ', $me->getName());
        $fname = $nameArr[0];
        unset($nameArr[0]);
        $lname = implode(' ', $nameArr);
        $this->data['title'] = 'Đăng nhập / Đăng ký';
        $this->data['content'] = 'client/pages/fb';
        $this->data['subcontent'] = null;
        $this->render('layouts/client', $this->data);
    }
    public function register()
    {
        $result = $this->model->register($_POST['register-email'], $_POST['register-password']);
        echo json_encode($result);
    }
    public function login()
    {
        $result = $this->model->login($_POST['signin-email'], $_POST['signin-password']);
        if (!empty($result)) {
            $_SESSION['user'] = $result;
        }
        echo json_encode($result);
    }
    public function logout()
    {
        if (!empty($_SESSION['user'])) {
            unset($_SESSION['user']);
            if (!empty($_SESSION['cart'])) {
                unset($_SESSION['cart']);
            }
            if (!empty($_SESSION['cart-total-amount'])) {
                unset($_SESSION['cart-total-amount']);
            }
            if (!empty($_SESSION['cart-total-quantity'])) {
                unset($_SESSION['cart-total-quantity']);
            }
            echo header("location: /");
        }
    }
    public function generateToken()
    {
        $token = md5(uniqid('molla'));
        $email = trim($_POST['email']);
        $tokenModel = new TokenModel();
        $check = $this->model->checkEmailExisted($email);
        if ($check) {
            $res = $tokenModel->add($email, $token);
            if (!empty($res)) {
                $this->sendEmail($email, "Mã xác nhận thay đổi mật khẩu của bạn là: $token");
                echo json_encode(['status' => 1]);
                return;
            } else {
                echo json_encode(['status' => 0]);
                return;
            }
        } else {
            echo json_encode(['status' => 0, 'errMsg' => 'Email chưa đăng ký tài khoản tại Molla!']);
            return;
        }
    }
    public function forgotPassword()
    {
        $this->data['title'] = 'Quên mật khẩu';
        $this->data['content'] = 'client/pages/forgot-password';
        $this->data['subcontent'] = null;
        $this->render('layouts/client', $this->data);
    }
    public function checkToken()
    {
        $token = trim($_POST['token']);
        $email = trim($_POST['email']);
        $tokenModel = new TokenModel();
        $check = $tokenModel->check($email, $token);
        if (!empty($check)) {
            echo json_encode(['status' => 1]);
            return;
        }
        echo json_encode(['status' => 0, 'errMsg' => 'Mã xác nhận đã hết hạn!']);
        return;
    }
    public function changePassword()
    {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        if (!empty($email) && !empty($password)) {
            $this->model->changePasswordByEmail($email, $password);
            echo json_encode(['status' => 1]);
            return;
        }
        echo json_encode(['status' => 0, 'errMsg' => 'Đừng có sửa bậy']);
        return;
    }
}
