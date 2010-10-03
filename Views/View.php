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
    //дефолтный акт.
    protected $defaultAct;

    /**
     * запустить шаблонизатор
     * @param RegistryContext $context
     */
    function input() {
        self::$isinput = true;
        include(RegistryContext::instance()->get('page_tpl'));
    }
    
    function  __construct() {
        //ставим отметку о том что View был уже запущен
        self::$isinput = false;
        RegistryContext::instance()->set('page_tpl', 'Page.tpl');
    }

    /**
     * Запустить акт
     * @param string $nameAct Имя акта
     * @param array $settings Массив, мозможных настроек, если вызывается другим актом
     */
    final function runAct($nameAct =  null, $settings = array()) {
        if (empty($nameAct)) {
            $nameAct = $this->defaultAct;
        }
        $nameAct = ucfirst($nameAct);
        $act = 'act' . ucfirst($nameAct);
        if (method_exists ($this, $act)) {
            return $this->$act(RegistryContext::instance());
        } else {
            Log::warning('У экшена ' . __CLASS__ . ' не реализован экт: ' . $nameAct);
            return false;
        }
        
    }
}
?>
