<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Command
 *
 * @author almaz
 */
abstract class Command {
    abstract function execute(RegistryRequest $request);

}
?>
