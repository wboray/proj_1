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
            'name'=>'Сет',
        ));

   //     $tbl->addRulesView('name', '<a href="newindex.php?view=sites&keyword_id=#id#">#name#</a>');
  //      $tbl->addRulesView('set', '<a href="newindex.php?view=sites&set_id=#s_id#">#set#</a>');
        $context->set('tpl', 'Sets_list.tpl');
        $context->set('h1', 'Все сеты');
        $context->set('title', 'Сеты');
        return true;

   }

   protected function actAdd ($context) {
        $request = RegistryRequest::instance();
        if ($request->is('set_name')) {
            $s = new Set;
            $s->name = $request->get('set_name');
            $s->add();
            $context->set('tpl', 'Sets_add.tpl');
            $context->set('result', "Чтото добавляется");
            $context->set('form', false);
        } else {
            $context->set('form', true);
            $context->set('tpl', 'Sets_add.tpl');
        }
        $context->set('h1', 'Добавление сета');
        $context->set('title', 'Добавление сета');
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