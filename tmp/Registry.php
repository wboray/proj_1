<?php

/**
 * Description of Registry
 *
 * @author asuslov
 */

abstract class Registry{

    protected $values = array();

    /**
     * Р Р€Р Т‘Р В°Р В»РЎРЏР ВµРЎвЂљ Р Р†РЎРѓР Вµ РЎРѓР Р†Р С•Р в„–РЎРѓРЎвЂљР Р†Р В°
     */
    public static function clean () {
        ##!!$this->values = array();
    }

    public function get($key) {
        if (isset($this->values[$key])) {
            return $this->values[$key];
        } else {
            Log::warning("'$key' Р Р…Р ВµРЎвЂљ РЎвЂљР В°Р С”Р С•Р С–Р С• РЎРѓР Р†Р С•Р в„–РЎРѓРЎвЂљР Р†Р В°");
        }
    }

    public function is($key) {
        if (isset($this->values[$key])) {
            return true;
        } else {
            return false;
        }
    }
   public function set($key, $value) {
        $this->values[$key] = $value;
   }

}
?>
