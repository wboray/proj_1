<?php
/* 
 * Р РЋР В±РЎР‚Р В°РЎРѓРЎвЂ№Р Р†Р В°Р ВµРЎвЂљ Р В·Р Р…Р В°РЎвЂЎР ВµР Р…Р С‘РЎРЏ Р С”Р В»РЎР‹РЎвЂЎР ВµР Р†Р С‘Р С”Р С•Р Р†
 */

require_once 'Queries.php';
$sql = Queries::getSql('RESET_PARSER');
DB::query($sql);
echo 'Р Р†РЎР‚Р С•Р Т‘Р Вµ РЎРѓР В±РЎР‚Р С•РЎРѓР С‘Р В»Р С‘';