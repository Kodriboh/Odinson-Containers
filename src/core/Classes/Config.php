<?php 

namespace core\Classes;

class Config 
{
    private $config = [];

    private static $instance = null;

    private function __construct(array $config)
    {
        $this->config = empty($config) ? $this->load() : $config;
    }

    /**
     * Load the values from the config files.
     * 
     * @return array $config
     */
    public static function load()
    {
        $app = require_once dirname(dirname(__DIR__)) . '/config/app.php';
        $db = require_once dirname(dirname(__DIR__)) . '/config/database.php';

        return [
            'app' => $app,
            'database' => $db
        ];
    }

    /**
     * Get a config.
     * 
     * @param string $config the config to retrieve.
     * @return array $config the config requested.
     */
    public function get(string $config = 'app') 
    {
        return $this->config[$config];
    }

    /**
     * Get an instance of Config.
     * 
     * @return Config $instance
     */
    public static function getInstance(array $config = [])
    {
        if (self::$instance == null) {
            self::$instance = new Config($config);
        }

        return self::$instance;
    }
}