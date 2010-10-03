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

class RegistryParser extends Registry{

    protected static $instance = null;
    final public  static function instance() {
        if (self::$instance === null) {
           self::$instance = new self();
        }
        return self::$instance;
    }
    protected function  __construct() {
        $this->set('ip', null); //РЎвЂљР ВµР С”РЎС“РЎвЂ°Р С‘Р в„– Р В·Р Р…Р В°РЎвЂЎР С‘РЎвЂљ
        $this->set('path_to_cookies', DIR_PATH . '/tmp/cookies');
        $this->set('_get', '');
        $this->set('_post', null); //post Р Р…Р Вµ Р С•РЎвЂљР С—РЎР‚Р В°Р Р†Р В»РЎРЏР ВµРЎвЂљРЎРѓРЎРЏ
    }


}
?>
