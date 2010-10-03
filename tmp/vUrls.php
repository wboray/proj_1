<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vUrls
 *
 * @author almaz
 */
require_once 'View.php';
require_once 'DB.php';
require_once 'Keywords.php';
require_once 'Sites.php';
require_once 'Urls.php';

class vUrls extends View{
   function execute(RegistryContext $context) {
    DB::connect();
    $request = RegistryRequest::instance();
        if ($request->is('site_id')) {
          $sql = Queries::getSql('URLS_AND_POS_FOR_SITE', array('site_id' => $request->get('site_id')));
            $tbl = new oTable(DBExt::selectToTable($sql. ' order by name ASC'));

            //РЎР‚Р ВµР В°Р В»Р С‘Р В·Р С•Р Р†Р В°РЎвЂљРЎРЉ, РЎвЂЎРЎвЂљР С•Р В±РЎвЂ№ Р С‘ Р С—Р С•РЎР‚РЎРЏР Т‘Р С•Р С” Р С—Р С•Р Т‘Р Т‘Р ВµРЎР‚Р В¶Р С‘Р Р†Р В°Р В»
            $tbl->viewColumns('name', 'pos', 'pos_dot', 'url');
            //$tbl->sort('url');
            //$tbl->jsonBuild();

            $tbl->setNamesColumns(array(
                'name'=>'Р РЋР В°Р в„–РЎвЂљ',
                'pos' =>'Р СџР С•Р В·Р С‘РЎвЂ Р С‘РЎРЏ',
                'pos_dot' => 'Р СџР С•Р В·Р С‘РЎвЂ Р С‘РЎРЏ РЎРѓ РЎвЂљР С•РЎвЂЎР С”Р С•Р в„–',
                'url' => 'Р С’Р Т‘РЎР‚Р ВµРЎРѓ'));
            $tbl->addRulesView('name', '<a href="#id#">#name#</a>');
            $tbl->addRulesView('url', '<a href="#id#">#url#</a>');
            $context->set('table', $tbl);


            $s = new Sites();
            $s->getObject('id', $request->get('site_id'));
            $context->set('h1', 'Р 