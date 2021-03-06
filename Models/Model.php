<?php
/* 
 * Model
 *
 * Класс родитель для вех моделей
 */

require_once 'DBExt.php';

abstract class Model {
    protected $tbl_name;
    private $values = null;
    protected $fields = array();

    final function  __construct() {
     /* убрал. чтобы например в update не заполнялись все поля, а только заданные значения
      *    if ($this->values === null) {
            $this->values = array();
            //заполнение полей дефолтными значениями
          foreach ($this->fields as $field => $value) {
                $this->values[$field] = $value;
            }

        }
      *  */
    }

    /**
     * Получает значения по полю
     * used for only unique fields
     */
    function getObject($field, $val) {
        // подумать, как от этого избавиться
        $val = addslashes($val);
        $values = DBExt::getByField($this->tbl_name, $field, $val); 
        if (empty($values)) return false;
        $this->values = array();
        //заполнение полей значениями
        foreach ($this->fields as $fld) {
            $this->values[$fld] = $values[$fld];
        }
        return true;
    }

    /**
     * Получить массив объектов
     */
    function getArrayObjects() {
        return DBExt::select($this->tbl_name);
    }

    /**
     * Вставляет данные в базу
     */
    function add () {
        return  DBExt::insert($this->tbl_name, $this->values);

    }
    function  __get($field) {
        if (array_key_exists($field, $this->values)) {
             return $this->values[$field];
        } else {
            Log::warning('Не возможно получить свойство. / ' . get_class($this) .'->' . $field . ' - не определено');
        }
       
    }

    function  __set($field, $value) {
        if (in_array($field, $this->fields)) {
            //экранируем все от греха по дельше
            $this->values[$field] = addslashes($value);
        } else {
            Log::warning('Не возможно задать свойство. / ' . get_class($this) .'->' . $field . ' - не определено');
        }
        
    }
    /**
     *
     * @param string $field обновить только конкретное поле
     */

    //сделать какойто идентификатор id каждому объекту модели
    function save($field = null) {
        if ($field) {
            $value = $this->__get($field);
            $result = DBExt::update($this->tbl_name, array($field => $value), 'id', $this->id);
        } else {
            $result = DBExt::update($this->tbl_name, $this->values, 'id', $this->id);
        }
        
    }
    function update () {}
    
    function delete() {}

}


