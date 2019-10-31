<?php

namespace Lmv\WriterBlog\Models;

require 'security/config.php';

class DbConnect
{
    protected function _dbConnect()
    {
        try {
            $db = new \PDO('mysql:host=' . getenv('SQLHOST') . ';dbname=blog;charset=utf8', getenv('SQL_USER'), getenv('SQL_PSWD'));
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
            return $db;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
//echo getenv('SQL_USER');
//putenv('DSN=mysql:host=db5000206120.hosting-data.io;dbname=dbs201063;charset=utf8');
//phpinfo();

// $db = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
// $db = new \PDO('mysql:host=db5000206120.hosting-data.io;dbname=dbs201063;charset=utf8', 'dbu330117', 'writerBlog_123');
// AuthUserFile "/homepages/12/d771396630/htdocs/writerBlog/chemin.php\security\ht.passwd"
