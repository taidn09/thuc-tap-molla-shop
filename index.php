<?php
session_start();
// auto load Models
set_include_path(get_include_path() . PATH_SEPARATOR . 'app/models/');
spl_autoload_extensions('.php');
spl_autoload_register();
date_default_timezone_set('Asia/Ho_Chi_Minh');
require_once 'bootstrap.php';
$app = new App();