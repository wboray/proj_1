<?php
/* 
 * Р вЂќР С•Р В±Р В°Р Р†Р В»Р ВµР Р…Р С‘Р Вµ Р С”Р В»РЎР‹РЎвЂЎР ВµР Р†РЎвЂ№РЎвЂ¦ РЎРѓР В»Р С•Р Р† Р С‘Р В· РЎвЂљР ВµР С”РЎРѓРЎвЂљР С•Р Р†Р С•Р С–Р С• РЎвЂћР В°Р в„–Р В»Р В°
 */
require_once DIR_PATH . '/Models/Keywords.php';
$k = new Keywords();
$handle = fopen(DIR_PATH . "/tmp/keywords.txt", "r");

while (!feof($handle)) {
    $str = ucfirst(strtolower(trim(fgets($handle, 512))));
    if ($str) {
        $k->name = $str;
        $k->add();
    }

}
fclose($handle);