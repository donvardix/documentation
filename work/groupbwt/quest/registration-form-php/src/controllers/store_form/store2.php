<?php
session_start();
require_once __DIR__ . '/../../models/Members.php';
require_once __DIR__ . '/../../controllers/HomeController.php';

use models\Members;
use controllers\HomeController;

$types = array('image/gif', 'image/png', 'image/jpeg');
if (!empty($_FILES['photo'])) {
    if (in_array($_FILES['photo']['type'], $types)) {
        $filename = HomeController::uploadImage($_FILES['photo']);
        Members::storeForm2($_POST, $filename, $_SESSION['email']);
        session_destroy();
        require_once __DIR__ . '/../../views/forms/form3.php';
    } else {
        echo 'The file is not a picture.';
    }
} else {
    session_destroy();
    require_once __DIR__ . '/../../views/forms/form3.php';
}
