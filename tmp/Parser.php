<?php
/**
 * Description of Parser
 *
 * @author almaz
 */

require_once 'Keywords.php';

abstract class Parser
{
    protected $curl;
    protected $curl_opt = array();
    protected $count_request;

    public function  __construct($settings) {
        RunTimer::addTimer('Curl');
    }
    /**
     *
     * Р СџР С•РЎРѓРЎвЂ№Р В»Р В°Р ВµРЎвЂљ Р В·Р В°Р С—РЎР‚Р С•РЎРѓРЎвЂ№ Р С‘ Р С—Р С• РЎвЂ Р С‘Р С”Р В»РЎС“ Р С—РЎР‚Р С•РЎвЂ¦Р С•Р Т‘Р С‘РЎвЂљ РЎРѓРЎвЂљРЎР‚Р В°Р Р…Р С‘РЎвЂ РЎвЂ№
     * @param Keyword $k  Р С”Р В»РЎР‹РЎвЂЎР ВµР Р†Р С‘Р С” Р С‘Р В· z_keywords
     *
     */
    abstract protected function parsing(Keywords $k);

    /**
     *
     * Р СџР С•Р В»РЎС“РЎвЂЎР В°Р ВµРЎвЂљ ip Р Т‘Р В»РЎРЏ Р С—Р В°РЎР‚РЎРѓР ВµРЎР‚Р В°
     * @return string IP Р В°Р Т‘РЎР‚Р ВµРЎРѓ
     *
     */
    abstract protected function getIp();


    /**
     * Р СџР С•Р В»РЎС“РЎвЂЎР В°Р ВµРЎвЂљ РЎРѓРЎвЂљРЎР‚Р С•Р С”РЎС“ Get-Р В·Р В°Р С—РЎР‚Р С•РЎРѓР В°
     * @return string GET-Р В·Р В°Р С—РЎР‚Р С•РЎРѓ
     *
     */
    protected function getGET(){}

    /**
     * Р СџР С•Р В»РЎС“РЎвЂЎР В°Р ВµРЎвЂљ РЎРѓРЎвЂљРЎР‚Р С•Р С”РЎС“ POST-Р В·Р В°Р С—РЎР‚Р С•РЎРѓР В°
     * @return string POST-Р В·Р В°Р С—РЎР‚Р С•РЎРѓ
     *
     */
    protected function getPOST(){
        return null;
    }

    final protected function request(){
        RunTimer::addPoint('Curl');
        curl_setopt_array($this->curl, $this->curl_opt);
        $response = curl_exec ($this->curl);
        RunTimer::endPoint('Curl');
        return $response;
    }

    final protected function initCurl(){
        $this->curl = curl_init ();
        $this->curl_opt[CURLOPT_HEADER] = false;
        $this->curl_opt[CURLOPT_RETURNTRANSFER] = true;
        $this->curl_opt[CURLOPT_FOLLOWLOCATION] = false;
        $this->curl_opt[CURLOPT_TIMEOUT] = 30;
    }


    final function  __destruct() {
            if($this->curl) curl_close ($this->curl);


    }

    abstract public function run(RegistryParser $config);

}

