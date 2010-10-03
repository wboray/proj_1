<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mvc
 *
 * @author almaz
 */
class Mvc {
    private $controllers;
    public static function getController($action) {
        switch ($action) {
            case 'addKeywords':
                $name_c = 'c'.ucfirst($action);
                include $name_c . '.php';
                return new $name_c();
            break;
        }
    }
}
?>
