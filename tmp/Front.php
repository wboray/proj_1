<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Front
 *
 * @author almaz
 */
class Front {
    
    public static function getCommand(RegistryRequest $request) {
            $nameCommand = 'c'.ucfirst($request->get('deamon')); 
            include_once $nameCommand . '.php';
            return new $nameCommand();
    }
    public static function getView(RegistryRequest $request) {
            $nameView = 'v'.ucfirst($request->get('view'));
            include_once $nameView . '.php'; 
            return new $nameView();
    }
}
?>
