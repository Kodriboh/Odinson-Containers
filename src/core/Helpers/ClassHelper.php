<?php 

namespace core\Helpers;

/** 
 * Bjornstad
 * @Author Luke McCann
 * 
 * Bootstrap
 * 
 * PHP Version 8.0
 */
class ClassHelper
{
    /**
     * Parse a classs name from the path. 
     */
    public static function nameFromUri(string $uri)
    {
        $class_name = ltrim(substr($uri, strrpos($uri, '\\')), '\\');

        return $class_name;
    }
}