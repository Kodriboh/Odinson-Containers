<?php 

namespace core\Utilities;

use core\Classes\App;
use Dotenv;

/** 
 * Bjornstad
 * @Author Luke McCann
 * 
 * Env
 * 
 * PHP Version 8.0
 */
class Env 
{
    private $loaded = false;

    private $dotenv;

    public function __construct(string $root)
    {
        $this->dotenv = Dotenv\Dotenv::createImmutable($root);
    }

    /**
     * Load environment variables using the dotenv autoloader.
     */
    public function load() 
    {
        if ($this->loaded) return;

        $this->dotenv->load();
        $this->loaded = true;
    }

    /**
     * Retrieve environment variable data.
     * 
     * @param string $value the value to retrieve
     * @param string $default the value to set if none exists
     */
    public static function env(string $value, string $default = '') 
    {
        if (!isset($_ENV[$value])) {
            $_ENV[$value] = $default;
        }

        return $_ENV[$value];
    }
}