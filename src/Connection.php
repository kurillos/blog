<?php
namespace App;

use PDO;

class Connection {
    public static function getPDO(): PDO {
        return new PDO('mysql:dbname=blog_caverne;host=127.0.0.1', 'root', 'root', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
      ]);
}}