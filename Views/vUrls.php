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

            //реализовать, чтобы и порядок поддерживал
            $tbl->viewColumns('name', 'pos', 'pos_dot', 'url');
            //$tbl->sort('url');
            //$tbl->jsonBuild();

            $tbl->setNamesColumns(array(
                'name'=>'Сайт',
                'pos' =>'Позиция',
                'pos_dot' => 'Позиция с точкой',
                'url' => 'Адрес'));
            $tbl->addRulesView('name', '<a href="#id#">#name#</a>');
            $tbl->addRulesView('url', '<a href="#id#">#url#</a>');
            $context->set('table', $tbl);


            $s = new Sites();
            $s->getObject('id', $request->get('site_id'));
            $context->set('h1', 'Информация по сайту "' . $s->name.'" '.date('d.m.Y', time()));

            } else {
                

            }
        $context->set('tpl', 'Urls.tpl');
        $context->set('title', 'Информация по сайту');
        $this->input($context);
    }

}

