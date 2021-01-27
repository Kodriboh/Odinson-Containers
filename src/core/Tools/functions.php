<?php 

use core\Utilities\Env;

/**
 * Global functions
 */

 /**
  * Env convenience function for cleaner calls to env.
  */
 function env(string $value, string $default = '') {
     return Env::env($value, $default);
 }