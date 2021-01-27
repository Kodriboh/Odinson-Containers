<?php

/**
 * Bjornstad
 * @Author Luke McCann
 * 
 * Debugger
 * 
 * PHP Version 8.0
 */
Class Debugger 
{

    /**
     * Dump the values passed in a pretty format, then die.
     * 
     * @param mixed $values the values to dump
     * @return void
     */
    public static function dd(mixed $values) {
        echo '<pre>';
        die(var_dump($values));
        echo '</pre>';
    }
}