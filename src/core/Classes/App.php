<?php

namespace core\Classes;

use core\Classes\Config;
use core\Services\AliasRegistrationService;
use core\Utilities\Env;

/** 
 * Bjornstad
 * @Author Luke McCann
 * 
 * App Singleton
 * 
 * PHP Version 8.0
 */
class App 
{
    private static $instance = null;

    private Config $config; 

    private array $app_config;
    private array $db_config;

    private string $root;

    private function __construct()
    {
        $this->config = Config::getInstance();
        $this->init();
    }

    /**
     * Initialize the application
     */
    private function init() 
    {
        $this->loadConfig();
        $this->setRoot($this->app_config['app_root']);
        $this->registerAliases($this->app_config['aliases']);
        $this->importEnvironmentVariables();
    }

    /**
     * Load configuration settings from config.
     */
    private function loadConfig() 
    {
        $this->app_config = $this->config->get();
        $this->db_config = $this->config->get('database');
    }

    /**
     * Get the root of the project.
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Set the project root.
     * 
     * @param string $root the project root path
     */
    public function setRoot(string $root) 
    {
        $this->root = $root;
    }

    /**
     * Register class aliases from app.php
     */
    private function registerAliases(array $aliases) 
    {
        AliasRegistrationService::register($aliases);
    }

    /**
     * Import environment variables from .env.
     */
    private function importEnvironmentVariables() 
    {
        $env = new Env($this->root);
        $env->load();
    }

    /**
     * Get an instance of App.
     * 
     * @return App $instance
     */
    public static function run()
    {
        if (self::$instance == null) {
            self::$instance = new App();
        }

        return self::$instance;
    }
}