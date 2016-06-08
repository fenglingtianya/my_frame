<?php

class Base_Autoload
{
    public static function autoload($class)
    {
        $callback = function($string) {
            return strtolower(preg_replace('#(?<=\P{Lu})(?=\p{Lu})#', '_', $string));
        };

        $file = join(DIRECTORY_SEPARATOR, array_map($callback, explode('_', $class))) . '.php';

        static $path = array(
            CONFIG_PATH,
            INCLUDE_PATH,
            LIBRARY_PATH,
            VENDOR_PATH,
            MODULE_PATH,
        );

        foreach ($path as $value) {
            $realfile = $value . DIRECTORY_SEPARATOR . $file;
            if (file_exists($realfile)) {
                include $realfile;
                return true;
            }
        }

        throw new Exception($file . ' not found');
    }

}
