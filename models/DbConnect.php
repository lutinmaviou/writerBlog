<?php

namespace Lmv\WriterBlog\Models;

class DbConnect
{
    protected function _dbConnect()
    {
        try {
            require 'security/config.php';
            $db = new \PDO('mysql:host=' . $SQL_host . ';dbname=' . $SQL_dbName . ';charset=utf8', $SQL_user, $SQL_pswd);
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
            return $db;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
