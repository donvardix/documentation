<?php
session_start();
require_once __DIR__.'/../../models/Members.php';
require_once __DIR__.'/../../controllers/HomeController.php';

use models\Members;
use controllers\HomeController;

$errors=HomeController::checkError();

if ($errors){
    if(Members::checkEmail($_POST['email'])){
        echo 'errorEmail';
    }else{
        Members::storeForm1($_POST);
        $_SESSION['status'] = 'form2';
        $_SESSION['email'] = $_POST['email'];
        HomeController::checkStatusForm();
    }
}else{
    header("HTTP/1.0 500 Internal Server Error");
}