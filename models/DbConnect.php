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

// $db = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
// $db = new \PDO('mysql:host=db5000206120.hosting-data.io;dbname=dbs201063;charset=utf8', 'dbu330117', 'writerBlog_123');
// AuthUserFile "/homepages/12/d771396630/htdocs/writerBlog/chemin.php\security\ht.passwd"
// AuthUserFile "C:\wamp64\www\writerBlog\security\ht.passwd"
// $db = new \PDO('mysql:host=' . $SQL_host . ';dbname=' . getenv('SQL_DBNAME') . ';charset=utf8', getenv('SQL_USER'), getenv('SQL_PSWD'));
