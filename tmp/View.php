<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of View
 *
 * @author almaz
 */
require_once 'Queries.php';
require_once 'oTable.php';
require_once 'RegistryContext.php';
abstract class View {
    private static $isinput = null;
    //Р Т‘Р ВµРЎвЂћР С•Р В»РЎвЂљР Р…РЎвЂ№Р в„– Р В°Р С”РЎвЂљ.
    protected $defaultAct;

    /**
     * Р В·Р В°Р С—РЎС“РЎРѓРЎвЂљР С‘РЎвЂљРЎРЉ РЎв‚¬Р В°Р В±Р В»Р С•Р Р…Р С‘Р В·Р В°РЎвЂљР С•РЎР‚
     * @param RegistryContext $context
     */
    function input() {
        self::$isinput = true;
        include(RegistryContext::instance()->get('page_tpl'));
    }
    
    function  __construct() {
        //РЎРѓРЎвЂљР В°Р Р†Р С‘Р С