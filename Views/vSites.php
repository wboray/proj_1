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

class vSites extends View{
    protected $defaultAct = 'view';
    function actView ($context) {
    $request = RegistryRequest::instance();

     if ($request->is('keyword_id')) {
        //сделать обработку  если запрос не выполнился
        $sql = Queries::getSql('URLS_AND_POS_FOR_KEYWORD', array('keyword_id' => $request->get('keyword_id')));
        $tbl = new oTable(DBExt::selectToTable($sql. ' order by pos DESC'));
        $context->set('table', $tbl);

                        $tbl->viewColumns('name', 'pos', 'url', 'pos_dot');
            //$tbl->sort('url');
            //$tbl->jsonBuild();

            $tbl->setNamesColumns(array(
                'name'=>'Сайт',
                'pos' =>'Позиция',
                'pos_dot' => 'Позиция с точкой',
                'url' => 'Адрес'));
        }
        if ($request->is('set_id')) {
            $sql = Queries::getSql('URLS_AND_POS_FOR_SET', array('set_id' => $request->get('set_id')));
            $tbl = new oTable(DBExt::selectToTable($sql));
            $context->set('table', $tbl);
            $tbl->separator('k_id');
            $tbl->viewColumns('name', 'pos', 'url', 'pos_dot');
            $tbl->setNamesColumns(array(
                'name'=>'Сайт',
                'pos' =>'Позиция',
                'pos_dot' => 'Позиция с точкой',
                'url' => 'Адрес'));
        }
        
        
        $context->set('h1', 'Позиции сайтов');
        $context->set('tpl', 'Sites.tpl');
        $context->set('title', 'Сайты');
    }


   //метод который вызывается при первом запуске
   //может потом или последним актом... когда закончатся все внутренние зависимости
   function execute(RegistryContext $context) {
        $request = RegistryRequest::instance();
        if ($request->is('act')) {
             $answerAct = self::runAct($request->get('act'));
        } else {
            $answerAct = self::runAct();
        }
        $this->input();
    }
}

