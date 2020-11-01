<?php

namespace app\engine;

class Autoload
{
    public $root = "app\\";

    function loadClass($className)
    {
        $className = str_replace($this->root, "", $className);
        $filename = '..\\' . $className . '.php';

        if (file_exists($filename)) {
            require_once($filename);
        }
    }
}
