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
            'name'=>'Р СћР ВµР С