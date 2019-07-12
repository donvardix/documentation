<?php
session_start();
require_once __DIR__ . '/../models/Members.php';
require_once __DIR__ . '/../controllers/HomeController.php';


$fn = ($p = key($_GET)) ? __DIR__ . '/../views/' . $p . '.php' : __DIR__ . '/../views/home.php';

(file_exists($fn)) ? require $fn : require __DIR__ . '/../views/404.html';
