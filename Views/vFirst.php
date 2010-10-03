<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vKeywords
 *
 * @author almaz
 */
require_once 'View.php';
require_once 'DB.php';
require_once 'Keywords.php';
require_once 'Sites.php';
class vFirst extends View{
    function execute(RegistryContext $context) {
        $context->set('tpl', 'First.tpl');
        $context->set('title', 'Главная');
        $context->set('h1', 'Главная');
        $this->input($context);
    }

    function input(RegistryContext $context) {
        include($context->get('page_tpl'));
    }
}
?>
