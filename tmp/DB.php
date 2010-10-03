<?php
#include 'MysqliExt.php';

require_once 'LogMysql.php';

Class DB {
    protected static $lnk = null;

    /**
     *
     * @param array $config
     */
    public function  __construct() {

    }

    final private static function connector($config){
        $lnk = null;
        $lnk = @new mysqli($config[0], $config[1], $config[2], $config[3]);
        if ($lnk->connect_errno) {
            LogMysql::errorQuery("Р СџР С•Р Т‘Р С”Р В»РЎР‹РЎвЂЎР ВµР Р…Р С‘Р Вµ Р С” РЎРѓР ВµРЎР‚Р Р†Р ВµРЎР‚РЎС“ MySQL Р Р…Р ВµР Р†Р С•Р В·Р С