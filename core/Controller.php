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
    public function uploadImage($image, $folder)
    {
        $target_dir = "public/assets/images/$folder/";
        $targetFileType = strtolower(pathinfo(basename($image['name']), PATHINFO_EXTENSION));
        $target_file = $target_dir . md5(strtolower(pathinfo(basename($image['name']), PATHINFO_FILENAME))).'.'.$targetFileType;
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
    public function uploadMultiImage($image, $folder)
    {
        $target_dir = "public/assets/images/$folder/";
        for ($i = 0; $i < count($image['name']); $i++) {
            $targetFileType = strtolower(pathinfo(basename($image['name'][$i]), PATHINFO_EXTENSION));
            $target_file = $target_dir . md5(strtolower(pathinfo(basename($image['name'][$i]), PATHINFO_FILENAME))).'.'.$targetFileType;
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
    public function checkRole($req = null)
    {
        if (!empty($_SESSION['admin'])) {
            $rolesArr  = $_SESSION['admin']['roles'];
            // nếu mà admin lớn nhất
            if ($_SESSION['admin']['email'] == 'taidn@gmail.com') {
                return true;
            }
            // quản lý
            if ($_SESSION['admin']['role'] == 1 && strpos($_SERVER['PATH_INFO'],'/admin/admin') ) {
                return true;
            }
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
        return true;
    }
    public function loadError()
    {   
        $arr = explode('/',$_SERVER['PATH_INFO']);    
        if(!empty($arr[1]) && $arr[1] == 'admin'){
            echo header("location: /admin/404");
            die;
        }
        echo header("location: /404");
    }
    public function loadErrAuth(){
        echo header("location: /admin/401");
    }
}
