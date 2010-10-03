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
require_once 'Thematics.php';

class vThematics extends View{
    protected $defaultAct = 'view';

    protected function actView ($context) {
        $sql = Queries::getSql('ALL_THEMATICS');
        $tbl = new oTable(DBExt::selectToTable($sql. ' order by name ASC'));
        $tbl->viewColumns('name');

        $context->set('table', $tbl);
        $tbl->setNamesColumns(array(
            'name'=>'Тематика',
        ));

   //     $tbl->addRulesView('name', '<a href="newindex.php?view=sites&keyword_id=#id#">#name#</a>');
  //      $tbl->addRulesView('set', '<a href="newindex.php?view=sites&set_id=#s_id#">#set#</a>');
        $context->set('tpl', 'Thematics_list.tpl');
        $context->set('h1', 'Все тематики');
        $context->set('title', 'Тематики');
        return true;

   }

   protected function actAdd ($context) {
        $request = RegistryRequest::instance();
        if ($request->is('thematic_name')) {
            $t = new Thematics;
            $t->name = $request->get('thematic_name');
            $t->add();
            $context->set('tpl', 'Thematics_add.tpl');
            $context->set('result', "Чтото добавляется");
            $context->set('form', false);
        } else {
            $context->set('form', true);
            $context->set('tpl', 'Thematics_add.tpl');
        }
        $context->set('h1', 'Добавление тематики');
        $context->set('title', 'Добавление тематики');
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

