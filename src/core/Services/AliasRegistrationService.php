<?php 

namespace core\Services;

use core\Helpers\ClassHelper;

/** 
 * Bjornstad
 * @Author Luke McCann
 * 
 * AliasRegistrationService
 * 
 * PHP Version 8.0
 */
class AliasRegistrationService 
{
    /**
     * Register aliases to their corresponding classes.
     * 
     * @param array $aliases
     */
    public static function register(array $aliases)
    {
        foreach ($aliases as $alias => $uri) {
            $class = ClassHelper::nameFromUri($uri);

            if (class_exists($class)) {
                class_alias($class, $alias);
            }
        }
    }
}