<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'DB.php';
class DBParserYandexXml extends DB{
   protected static $lnk2 = null;

   /*
    * Самодостаточный объект, который создает себе еще одно соединение для своих нужд
    */
    public function  __construct() {
        if (self::$lnk2 == null) {
            RegistryDb::instance()->setSettings('account', array('localhost','webexpert_acc', '3k8GnrcM', 'webexpert_acc'));
            self::$lnk2 = parent::connect('account');
        }
       
    }

   function getip(){

        $result = self::query('SELECT ri_id, ri_ip  FROM z_routeip
            WHERE ri_isactive = 1 AND ri_quota>200 ORDER BY ri_quota DESC, RAND() LIMIT 0, 1', self::$lnk2);

        if ($result->num_rows > 0){
            $row = $result->fetch_assoc();
            self::query('UPDATE z_routeip SET ri_quota=ri_quota - 1 WHERE ri_id = ' . $row['ri_id'], self::$lnk2);
            return $row['ri_ip'];
        } else {
            Log::warning('Закончились IP');
        }
         
    }

     function getKeywords($count = 1){
        $result = self::query ("SELECT id, name, region_id from Keywords" .
	" WHERE yandex = 'NoData' " .
	" ORDER BY id" .
	" LIMIT 0, " . $count);      
        if ($result->num_rows == 0) return array();


        $ids = array ();
        while ($row = $result->fetch_assoc()) {
           $k = new Keywords();
           $k->id = $row['id'];
           $ids[] = $row['id'];
           $k->name = $row['name'];
           $k->region_id = $row['region_id'];
           $r[] = $k;
        }
        //ставим отметку, что ключевики заняты
        self::query ("Update  Keywords set yandex = 'Busy'" .
                " where id in (" . implode(', ', $ids) . ")");

        return $r;
    }

    function setPositions (){

    }



}
?>
