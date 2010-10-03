<?php
/* 
 * Model
 *
 * Класс родитель для вех моделей
 */

require_once 'DBExt.php';

abstract class Model {
    protected $tbl_name;
    protected $fields = array();

    final function  __construct() {
        DB::connect(Config::getDbConfig());
    }
    function getId() {}


    /**
     * Вставляет данные в базу
     */
    function add () { die($this->tbl_name);
//        if (func_num_args ()) {
//            $args = func_get_args();
//            if (DBExt::insert($this->tbl_name, $args, array_keys($this->fields))) {
//                return true;
//            } else {
//                return false;
//            }
//        } else {
//            Log::warning (__CLASS__.'->'.__METHOD__.' не были переданы агрументы');
//        }

    }
    function getField($id) {

    }


    function update () {}
    
    function delete() {}

}

?>
