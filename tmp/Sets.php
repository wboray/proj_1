<?php
/**
 * Sites
 *
 * Р С”Р В»Р В°РЎРѓРЎРѓ РЎРѓР ВµРЎвЂљР С•Р Р† Р С”Р В»РЎР‹РЎвЂЎР ВµР Р†Р С‘Р С”Р С•Р Р†
 */
require_once 'Model.php';
class Sets extends Model {
    protected $tbl_name = __CLASS__;
    protected $fields = array (
        'id',
        'name',
        'date',
    );
}