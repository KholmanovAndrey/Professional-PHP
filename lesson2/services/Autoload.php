<?php

namespace App\services;

class Autoload
{
    public function loadClass($className)
    {
        $className = str_replace('\\', '/', substr($className, 4));
        $file = $_SERVER['DOCUMENT_ROOT'] .
            "/../{$className}.php";
        if (file_exists($file)) {
            include $file;
        }
    }
}