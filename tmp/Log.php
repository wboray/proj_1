<?php
/**
 * Log
 *
 * Р С™Р В»Р В°РЎРѓРЎРѓ Р Т‘Р В»РЎРЏ Р С•РЎвЂљР В»Р В°Р Т‘Р С”Р С‘ Р С”Р С•Р Т‘Р В°
 */
 
class Log {
    /**
     * РЎС“РЎР‚Р С•Р Р†Р ВµР Р…РЎРЉ Р С‘ РЎвЂљР С‘Р С— Р С•РЎвЂљР В»Р В°Р Т‘Р С”Р С‘, Р Т‘Р С•Р В»Р В¶Р ВµР Р… Р В·Р В°Р Т‘Р В°Р Р†Р В°РЎвЂљРЎРЉРЎРѓРЎРЏ Р С•Р Т‘Р С‘Р Р… РЎР‚Р В°Р В· Р С‘ РЎвЂљР С•Р В»РЎРЉР С”Р С• Р Р† Р Р…Р В°РЎвЂЎР В°Р В»Р Вµ
     */
    private static $_debugLevel = null;
    private static $_screen = false;
    private static $_file = false;
    private static $aLog = array();
    private static $i = 0;
    public static function setLevel($num) {
        if (self::$_debugLevel === null) {
            if ($num){
                 switch($num) {
                    case 1:
                        self::$_screen = true;
                        break;
                    case 2:
                        self::$_file = true;
                        break;
                    case 3:
                        self::$_screen = true;
                        self::$_file = true;
                }
            } else {
                self::$_debugLevel = false;
            }
        }
    }

    /**
     * Р вЂ™РЎвЂ№Р Р†Р С•Р Т‘ Р Т‘Р В°Р С