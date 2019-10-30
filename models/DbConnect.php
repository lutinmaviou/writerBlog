<?php

namespace Lmv\WriterBlog\Models;

class DbConnect
{
    protected function _dbConnect()
    {
        try {
            $db = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
            return $db;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}

// $db = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
// $db = new \PDO('mysql:host=db5000206120.hosting-data.io;dbname=dbs201063;charset=utf8', 'dbu330117', 'writerBlog_123');
