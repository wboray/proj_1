<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegistryParser
 *
 * @author asuslov
 */
require_once 'Registry.php';

class RegistryRequest extends Registry{

    protected static $instance = null;
    final public  static function instance() {
        if (self::$instance === null) {
           self::$instance = new self();
        }
        return self::$instance;
    }
    /**
     * Р В Р В°Р В·Р В±Р С‘РЎР‚Р В°Р ВµР С