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
     * Разбираем входящие данные
     */
    protected function __construct(){
        if (isset($_SERVER['REQUEST_METHOD'])) {
            foreach ($_REQUEST as $key => $val) {
            $this->set($key, trim($val));
            }

        } else if(isset($_SERVER['argv'])) {
            foreach ($_SERVER['argv'] as $arg) {
                if (strpos($arg, '=')) {
                    list($key, $val) = explode("=", $arg);
                    $this->set(strtolower($key), $val);
                }
            }
        }
    }
}
?>
