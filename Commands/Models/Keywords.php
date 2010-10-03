<?php
/**
 * Keywords
 *
 * класс ключевых слов
 */
require_once 'Model.php';
class Keywords extends Model {
    const tbl_name = __CLASS__;
    const fields = array (
        'id' => null,
        'name' => '',
        'region_id' => '',
    );

}

