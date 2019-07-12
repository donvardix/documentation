<?php

namespace models;

require __DIR__ . '/connect_db.php';

use PDO;

class Members
{

    public static function storeForm1($arr)
    {
        global $pdo;
        $sql = "INSERT INTO members(firstname, lastname, birthdate, reportsubject, country, phone, email) VALUES(?, ?, ?, ?, ?, ?, ?)";
        $query = $pdo->prepare($sql);
        $query->execute([
            $arr['firstname'],
            $arr['lastname'],
            $arr['birthdate'],
            $arr['reportsubject'],
            $arr['country'],
            $arr['phone'],
            $arr['email']
        ]);
    }

    public static function checkEmail($email)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT email FROM members WHERE email =?');
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public static function storeForm2($arr, $filename, $email)
    {
        global $pdo;
        $company = !empty($arr['company']) ? $arr['company'] : NULL;
        $position = !empty($arr['position']) ? $arr['position'] : NULL;
        $aboutme = !empty($arr['aboutme']) ? $arr['aboutme'] : NULL;
        $sql = "UPDATE members SET company = ?, position = ?, aboutme = ?, photo = ? WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$company, $position, $aboutme, $filename, $email]);
    }

    public static function countMembers()
    {
        global $pdo;
        $query = $pdo->prepare('SELECT COUNT(*) FROM members');
        $query->execute();
        $count = $query->fetchColumn();
        return $count;
    }

    public static function countries()
    {
        global $pdo;
        $query = $pdo->query('SELECT country FROM countries')->fetchAll(PDO::FETCH_OBJ);
        return $query;
    }

    public static function allMembers()
    {
        global $pdo;
        $limit = 5;

        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }

        $starting_limit = ($page - 1) * $limit;
        $show = "SELECT * FROM members ORDER BY id DESC LIMIT $starting_limit, $limit";

        $r = $pdo->prepare($show);
        $r->execute();
        $res = $r->fetchAll(PDO::FETCH_OBJ);

        return $res;

    }

    public static function pagination()
    {
        global $pdo;
        $limit = 5;
        $query = "SELECT * FROM members";

        $s = $pdo->prepare($query);
        $s->execute();
        $total_results = $s->rowCount();
        $total_pages = ceil($total_results / $limit);
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $getPage = $_GET['page'];
        }

        return ['page'=>$page, 'total_pages'=>$total_pages, 'getPage'=>$getPage];
    }

}