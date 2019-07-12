<?php

namespace controllers;

class HomeController
{

    public static function title()
    {
        return 'To participate in the conference, please fill out the form';
    }

    public static function checkError()
    {
        if(in_array("", $_POST)){
            return false;
        }
        return true;
    }

    public static function checkStatusForm()
    {
        $views = __DIR__ . '/../views/forms/';
        switch ($_SESSION['status']){
            case '':
                return require_once $views . 'form1.php';
                break;
            case 'form2':
                return require_once $views . 'form2.php';
                break;
        }
    }

    public static function uploadImage($photo)
    {
        $photo_name = $photo['name'];
        if (!empty($photo_name)) {
            $expansion = pathinfo($photo_name, 4);
            $filename = 'resources/uploads/' . uniqid() . '.' . $expansion;
            move_uploaded_file($photo['tmp_name'], __DIR__ . '/../' . $filename);
            return $filename;
        } else {
            return '/resources/images/default.png';
        }
    }

}