<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of List
 *
 * @author Alexander
 */
class oList {
    private $page = 1;
    private $search = '';
    private $sort = null;
    private $directSort = 'ASC';
    private $altWhere = '';
    private $name = null;
    private $headers = array();
    private $htmlHeaders = array();
    private $values = array();

    function __construct(array $list) {
        $this->values = $list;
    }
}
?>
