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

    //вынести в пакеты
    $request = RegistryRequest::instance();

// более асбтрагировать
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
                $context->set('result', "Чтото добавляется");
                $context->set('form', false);

            } else{
                $context->set('form', true);
                
            }
            $context->set('tpl', 'Keywords_add.tpl');
            $context->set('h1', 'Добавление ключевых слов');
        }
    } else {
        $sql = Queries::getSql('ALL_KEYWORDS');
        $tbl = new oTable(DBExt::selectToTable($sql. ' order by name ASC'));
        $tbl->viewColumns('name', 'yandex', 'set', 'thematic');

        $context->set('table', $tbl);
                $tbl->setNamesColumns(array(
                    'name'=>'Ключевое слово',
                    'yandex'=>'Яндекс',
                    'set'=>'Набор',
                    'thematic'=>'Тематика',
                    ));
                $tbl->addRulesView('name', '<a href="newindex.php?view=sites&keyword_id=#id#">#name#</a>');
                $tbl->addRulesView('set', '<a href="newindex.php?view=sites&set_id=#s_id#">#set#</a>');
        $context->set('tpl', 'Keywords_list.tpl');
        $context->set('h1', 'Все ключевые слова');
    }

    $context->set('title', 'Ключевики');
    $this->input($context);
    }

}
