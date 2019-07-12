<?php

require_once __DIR__ . '/../config.php';

$pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'], $db['user'], $db['password']);


