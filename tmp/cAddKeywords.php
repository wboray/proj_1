<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cAddKeywords
 *
 * @author almaz
 */
require_once 'Command.php';

class cAddKeywords extends Command {

    function  execute(RegistryRequest $request) {
        include_once DIR_PATH . '/Daemons/AddKeywords.php';
    }
    function  __construct() {
        
    }
}

