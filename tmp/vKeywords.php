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

require_once 'Keywords.php';
require_once 'Sites.php';
require_once 'Sets.php';
require_once 'Thematics.php';
class vKeywords extends View{
    function execute(RegistryContext $context) {
    DB::connect();

    //Р Р†РЎвЂ№Р Р…Р ВµРЎРѓРЎвЂљР С‘ Р Р† Р С—Р В°Р С”Р ВµРЎвЂљРЎвЂ№
    $request = RegistryRequest::instance();

// Р В±Р С•Р В»Р ВµР Вµ Р В°РЎРѓР В±РЎвЂљРЎР‚Р В°Р С–Р С‘РЎР‚Р С•Р Р†Р В°РЎвЂљРЎРЉ
    //
    if ($request->is('act')) {
        if ($request->get('act') == 'add') {
            if ($request->is('keywords_text')) {
                $kw = explode("\n", $request->get('keywords_text'));
                $k = new Keywords();
             
                if ($request->is('name_thematic')) {
                    $theme = new Thematics();
                    if (!$theme->getObject('name', $request->get('name_thematic'))) {
                       $theme->name = $request->get('name_thematic');
                       $theme->id = $theme->add();
                    }
                    $k->thematic_id = $theme->id;
                }
                if ($request->is('name_set')) {
                    $set = new Sets();
                    if (!$set->getObject('name', $request->get('name_set'))) {
                       $set->name = $request->get('name_set');
                       $set->id = $set->add();
                    }
                    $k->set_id = $set->id;
                }
                $k->region_id = 213;
                foreach ($kw as $v) {
                    if(trim($v)) {
                     $k->name = trim($v);
                     $k->add();
                    }
                }
                $context->set('result', "Р В§РЎвЂљР С•РЎвЂљР С• Р Т‘Р С•Р В±Р В°Р Р†Р В»РЎРЏР ВµРЎвЂљРЎРѓРЎРЏ");
                $context->set('form', false);

            } else{
                $context->set('form', true);
                
            }
            $context->set('tpl', 'Keywords_add.tpl');
            $context->set('h1', 'Р вЂќР С•Р В±Р В°Р Р†Р В»Р ВµР Р…Р С‘Р Вµ Р С”Р В»РЎР‹РЎвЂЎР ВµР Р†РЎвЂ№РЎвЂ¦ РЎРѓР В»Р С•Р Р†');
        }
    } else {
        $sql = Queries::getSql('ALL_KEYWORDS');
        $tbl = new oTable(DBExt::selectToTable($sql. ' order by name ASC'));
        $tbl->viewColumns('name', 'yandex', 'set', 'thematic');

        $context->set('table', $tbl);
                $tbl->setNamesColumns(array(
                    'name'=>'Р С™Р В»РЎР‹РЎвЂЎР ВµР Р†Р С•Р Вµ РЎРѓР В»Р С•Р Р†Р С•',
                    'yandex'=>'Р Р‡Р Р…Р Т‘Р ВµР С”РЎРѓ',
                    'set'=>'Р СњР В°Р В±Р С•РЎР‚',
                    'thematic'=>'Р СћР ВµР С