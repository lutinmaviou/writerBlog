<?php

namespace Lmv\WriterBlog\Models;

class DbConnect
{
    protected function _dbConnect()
    {
        try {
            require 'security/config.php';
            $db = new \PDO('mysql:host=' . $SQL_host . ';dbname=' . getenv('SQL_DBNAME') . ';charset=utf8', getenv('SQL_USER'), getenv('SQL_PSWD'));
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
            return $db;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
// $db = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
// $db = new \PDO('mysql:host=db5000206120.hosting-data.io;dbname=dbs201063;charset=utf8', 'dbu330117', 'writerBlog_123');
// $db = new \PDO('mysql:host=' . getenv('SQL_HOST') . ';dbname=' . getenv('SQL_DBNAME') . ';charset=utf8', getenv('SQL_USER'), getenv('SQL_PSWD'));
// AuthUserFile "/homepages/12/d771396630/htdocs/writerBlog/chemin.php\security\ht.passwd"
// $db = new \PDO('mysql:host=' . $SQL_host . ';dbname=' . getenv('SQL_DBNAME') . ';charset=utf8', getenv('SQL_USER'), getenv('SQL_PSWD'));
