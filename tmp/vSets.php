<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'View.php';
require_once 'Sets.php';

class vSets extends View{
    protected $defaultAct = 'view';

    protected function actView ($context) {
        $sql = Queries::getSql('ALL_SETS');
        $tbl = new oTable(DBExt::selectToTable($sql. ' order by name ASC'));
        $tbl->viewColumns('name');

        $context->set('table', $tbl);
        $tbl->setNamesColumns(array(
            'name'=>'Р РЋР ВµРЎвЂљ',
        ));

   //     $tbl->addRulesView('name', '<a href="newindex.php?view=sites&keyword_id=#id#">#name#</a>');
  //      $tbl->addRulesView('set', '<a href="newindex.php?view=sites&set_id=#s_id#">#set#</a>');
        $context->set('tpl', 'Sets_list.tpl');
        $context->set('h1', 'Р вЂ™РЎРѓР Вµ РЎРѓР ВµРЎвЂљРЎвЂ№');
        $context->set('title', 'Р РЋР ВµРЎвЂљРЎвЂ№');
        return true;

   }

   protected function actAdd ($context) {
        $request = RegistryRequest::instance();
        if ($request->is('set_name')) {
            $s = new Set;
            $s->name = $request->get('set_name');
            $s->add();
            $context->set('tpl', 'Sets_add.tpl');
            $context->set('result', "Р В§РЎвЂљР С•РЎвЂљР С• Р Т‘Р С•Р В±Р В°Р Р†Р В»РЎРЏР ВµРЎвЂљРЎРѓРЎРЏ");
            $context->set('form', false);
        } else {
            $context->set('form', true);
            $context->set('tpl', 'Sets_add.tpl');
        }
        $context->set('h1', 'Р вЂќР С•Р В±Р В°Р Р†Р В»Р ВµР Р…Р С‘Р Вµ РЎРѓР ВµРЎвЂљР В°');
        $context->set('title', 'Р вЂќР С•Р В±Р В°Р Р†Р В»Р ВµР Р…Р С‘Р Вµ РЎРѓР ВµРЎвЂљР В°');
   }
   //Р С