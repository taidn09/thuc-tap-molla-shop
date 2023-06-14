<?php
class Controller
{
    public function model($model)
    {
        if (file_exists(_DIR_ROOT . '/app/models/' . $model . '.php')) {
            require_once _DIR_ROOT . '/app/models/' . $model . '.php';
            if (class_exists($model)) {
                $model = new $model();
                return $model;
            }
        }

        return false;
    }
    public function render($view, $data = [])
    {
        if ($data) {
            extract($data);
        }
        if (file_exists(_DIR_ROOT . '/app/views/' . $view . '.php')) {
            require_once _DIR_ROOT . '/app/views/' . $view . '.php';
        }
    }
    public function sendEmail($receiver, $message)
    {
        global $mail;
        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'taint3112@gmail.com';
            $mail->Password = 'uitgjklgecnxvfhj';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom('taint3112@gmail.com', 'Molla');
            $mail->addAddress($receiver);
            $mail->isHTML(true);
            $mail->Subject = 'Notification';
            $mail->Body    = $message;
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    public function checkUserLogin()
    {
        return isset($_SESSION['user']);
    }
    public function uploadImage($image, $folder, $time = null)
    {
        $target_dir = "public/assets/images/$folder/";
        $targetFileType = strtolower(pathinfo(basename($image['name']), PATHINFO_EXTENSION));
        if ($time) {
            $target_file = $target_dir . md5(strtolower(pathinfo(basename($image['name']), PATHINFO_FILENAME)) . $time) . '.' . $targetFileType;
        } else {
            $target_file = $target_dir . md5(strtolower(pathinfo(basename($image['name']), PATHINFO_FILENAME))) . '.' . $targetFileType;
        }
        if (file_exists($target_file)) {
            return 'Ảnh đã tồn tại';
        }
        if ($image['size'] > 1000000) {
            return "Ảnh vượt quá kích thướt 1MB";
        }
        if (
            $targetFileType != 'jpg' && $targetFileType != 'jpeg'
            && $targetFileType != 'png'
        ) {
            return "Vui lòng chọn file hình ảnh";
        }
        if (!move_uploaded_file($image['tmp_name'], $target_file)) {
            return "Tải ảnh không thành công";
        }
        return null;
    }
    public function uploadMultiImage($image, $folder, $time = null)
    {
        $target_dir = "public/assets/images/$folder/";
        for ($i = 0; $i < count($image['name']); $i++) {
            $targetFileType = strtolower(pathinfo(basename($image['name'][$i]), PATHINFO_EXTENSION));
            if ($time) {
                $target_file = $target_dir . md5(strtolower(pathinfo(basename($image['name'][$i]), PATHINFO_FILENAME)) . $time) . '.' . $targetFileType;
            } else {
                $target_file = $target_dir . md5(strtolower(pathinfo(basename($image['name'][$i]), PATHINFO_FILENAME))) . '.' . $targetFileType;
            }
            if (file_exists($target_file)) {
                return 'Ảnh đã tồn tại';
            }
            if ($image['size'][$i] > 1000000) {
                return "Ảnh vượt quá kích thướt 1MB";
            }
            if (
                $targetFileType != 'jpg' && $targetFileType != 'jpeg'
                && $targetFileType != 'png'
            ) {
                return "Vui lòng chọn file hình ảnh";
            }
            if (!move_uploaded_file($image['tmp_name'][$i], $target_file)) {
                return "Tải ảnh không thành công";
            }
        }
        return null;
    }
    public function checkAdminLogin()
    {
        $arr = $_SERVER['REQUEST_URI'];
        if (explode("/", $arr)[1] == 'admin' && empty($_SESSION['admin'])) {
            if ($_SERVER['REQUEST_URI'] != '/admin/dashboard/login') {
                echo header("location: /admin/dashboard/login");
            }
        }
    }
    public function checkRolePost($req = null)
    {
        if (!empty($_SESSION['admin'])) {
            // quản lý
            $adminModel = new AdminModel();
            $admin = $adminModel->getAdminById($_SESSION['admin']['adminId']);
            if (empty($admin)) {
                echo json_encode(['status' => 2]);
                die;
            }
            if ($admin['role'] != 0) {
                $positionModel = new PositionModel();
                $res = $positionModel->getRoles($admin['role']);
                if (empty($res)) {
                    echo json_encode(['status' => 2]);
                    die;
                }
                $rolesArr = explode(',', $res['rolesString']);
                // ngược lại
                if ($req == null) {
                    $arr = explode('/', $_SERVER['PATH_INFO']);
                    $adminReq =  $arr[2];
                    $adminReq .= !empty($arr[3]) ? '-' . $arr[3] : '';
                    if (!in_array($adminReq, $rolesArr)) {
                        echo json_encode(['status' => 2]);
                        die;
                    }
                } else {
                    if (!in_array($req, $rolesArr)) {
                        echo json_encode(['status' => 2]);
                        die;
                    }
                }
            }
        }
        return true;
    }
    public function checkRole($req = null)
    {
        if (!empty($_SESSION['admin'])) {
            // quản lý
            $adminModel = new AdminModel();
            $admin = $adminModel->getAdminById($_SESSION['admin']['adminId']);
            if (empty($admin)) {
                return false;
            }
            if ($admin['role'] != 0) {
                $positionModel = new PositionModel();
                $res = $positionModel->getRoles($admin['role']);
                if (empty($res)) {
                    return false;
                }
                $rolesArr = explode(',', $res['rolesString']);
                // ngược lại
                if ($req == null) {
                    $arr = explode('/', $_SERVER['PATH_INFO']);
                    $adminReq =  $arr[2];
                    $adminReq .= !empty($arr[3]) ? '-' . $arr[3] : '';
                    return in_array($adminReq, $rolesArr);
                } else {
                    return in_array($req, $rolesArr);
                }
            }
        }
        return true;
    }
    public function checkUserValid()
    {
        if (!empty($_SESSION['user'])) {
            $userModel = new UserModel();
            $check = $userModel->getUserById($_SESSION['user']['userId']);
            if (empty($check)) {
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
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    echo json_encode(['status' => 2]);
                    die;
                } else {
                    header("Location: " . $_SERVER['PHP_SELF']);
                }
            }
        }
        return true;
    }
    public function checkAdminExistsAndRoleValid()
    {
        if (!empty($_SESSION['admin'])) {
            $adminModel = new AdminModel();
            $check = $adminModel->getAdminById($_SESSION['admin']['adminId']);
            $check1 = $adminModel->getRoles($_SESSION['admin']['adminId']);
            if (empty($check) || empty($check1)) {
                unset($_SESSION['admin']);
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    echo json_encode(['status' => 2]);
                    die;
                } else {
                    header("Location: " . $_SERVER['PHP_SELF']);
                }
            }
        }
        return true;
    }
    public function loadError()
    {
        $arr = explode('/', $_SERVER['PATH_INFO']);
        if (!empty($arr[1]) && $arr[1] == 'admin') {
            echo header("location: /admin/404");
            die;
        }
        echo header("location: /404");
    }
    public function loadErrAuth()
    {
        echo header("location: /admin/401");
    }
}
