<?php

namespace Lmv\writerBlog;

class Autoloader
{
    static function register()
    {
        // spl_autoload_register prend en paramètre la fonction permettant d'inclure 
        // les classes nécessaires
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
    static function autoload($class)
    {
        $class = str_replace(__NAMESPACE__ . '\\', '', $class);
        $class = str_replace('\\', '/', $class);
        require 'models/' . $class . '.php';
    }
}
