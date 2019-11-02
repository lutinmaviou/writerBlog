<?php

namespace Lmv\WriterBlog;

class Autoloader
{
    //private $models;
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
    static function autoload($class)
    {
        //var_dump($class); // Lmv\WriterBlog\Models\PostsMngr
        $class = str_replace(__NAMESPACE__ . '\Models\\', '', $class);
        //$class = str_replace('\\', '/', $class);
        //var_dump($class); // PostsMngr
        //var_dump(__NAMESPACE__); // Lmv\WriterBlog
        //var_dump(__FILE__); // C:\wamp64\www\writerBlog\Autoloader.php
        //var_dump(__DIR__); // C:\wamp64\www\writerBlog

        require 'models/' . $class . '.php';
    }
}
