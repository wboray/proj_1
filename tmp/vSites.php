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
        //РЎРѓР Т‘Р ВµР В»Р В°РЎвЂљРЎРЉ Р С•Р В±РЎР‚Р В°Р В±Р С•РЎвЂљР С”РЎС“  Р ВµРЎРѓР В»Р С‘ Р В·Р В°Р С—РЎР‚Р С•РЎРѓ Р Р…Р Вµ Р Р†РЎвЂ№Р С—Р С•Р В»Р Р…Р С‘Р В»РЎРѓРЎРЏ
        $sql = Queries::getSql('URLS_AND_POS_FOR_KEYWORD', array('keyword_id' => $request->get('keyword_id')));
        $tbl = new oTable(DBExt::selectToTable($sql. ' order by pos DESC'));
        $context->set('table', $tbl);

                        $tbl->viewColumns('name', 'pos', 'url', 'pos_dot');
            //$tbl->sort('url');
            //$tbl->jsonBuild();

            $tbl->setNamesColumns(array(
                'name'=>'Р РЋР В°Р в„–РЎвЂљ',
                'pos' =>'Р СџР С•Р В·Р С‘РЎвЂ Р С‘РЎРЏ',
                'pos_dot' => 'Р СџР С•Р В·Р С‘РЎвЂ Р С‘РЎРЏ РЎРѓ РЎвЂљР С•РЎвЂЎР С”Р С•Р в„–',
                'url' => 'Р С’Р Т‘РЎР‚Р ВµРЎРѓ'));
        }
        if ($request->is('set_id')) {
            $sql = Queries::getSql('URLS_AND_POS_FOR_SET', array('set_id' => $request->get('set_id')));
            $tbl = new oTable(DBExt::selectToTable($sql));
            $context->set('table', $tbl);
            $tbl->separator('k_id');
            $tbl->viewColumns('name', 'pos', 'url', 'pos_dot');
            $tbl->setNamesColumns(array(
                'name'=>'Р РЋР В°Р в„–РЎвЂљ',
                'pos' =>'Р СџР С•Р В·Р С‘РЎвЂ Р С‘РЎРЏ',
                'pos_dot' => 'Р СџР С•Р В·Р С‘РЎвЂ Р С‘РЎРЏ РЎРѓ РЎвЂљР С•РЎвЂЎР С”Р С•Р в„–',
                'url' => 'Р С’Р Т‘РЎР‚Р ВµРЎРѓ'));
        }
        
        
        $context->set('h1', 'Р СџР С•Р В·Р С‘РЎвЂ Р С‘Р С‘ РЎРѓР В°Р в„–РЎвЂљР С•Р Р†');
        $context->set('tpl', 'Sites.tpl');
        $context->set('title', 'Р РЋР В°Р в„–РЎвЂљРЎвЂ№');
    }


   //Р С