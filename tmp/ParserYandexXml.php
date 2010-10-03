<?php

/**
 *  ParserYandexXml
 *
 * Р СџР В°РЎР‚РЎРѓР С‘РЎвЂљ Yandex.Xml
 * @author almaz
 */
require_once 'Parser.php';
require_once DIR_PATH . '/Models/Keywords.php';
require_once DIR_PATH . '/Models/Sites.php';
require_once DIR_PATH . '/Models/Urls.php';
require_once DIR_PATH . '/Models/Positions.php';
class ParserYandexXml extends Parser{
    protected function  getIp() {
        return $this->db->getIp();
    }

    /**
     * Constructing Xml request for Yandex.ru
     * @param page page
     * @return string
     */
    protected function getXMLRequest($query, $page = 1){
        $data = '<?xml version="1.0" encoding="windows-1251"?>'."\r\n";
        $data .= "<request>\r\n";
        $data .= "<query>$query</query>\r\n";
        $data .= "<page>$page</page>\r\n";
        $data .= "<groupings>\r\n";
        $data .= "<groupby attr=\"d\" mode=\"deep\" groups-on-page=\"100\" docs-in-group=\"1\" />\r\n";
        $data .= "</groupings>\r\n";
        $data .= "</request>\r\n";
        return  $data;
    }

    // cleaning query
    protected function setQuery($query){
        $query=str_replace('&','&amp;', $query);
        $query=str_replace('<','&lt;', $query);
        $query=str_replace('>','&gt;', $query);
        return trim($query);
    }


    // cleaning url for compare
    protected function getHost($url){
        return str_replace ("www.", "",parse_url(strtolower($url), PHP_URL_HOST));
    }

    protected function getPath($url){
        return parse_url ($url, PHP_URL_PATH);
    }

    protected function getGET($region){

        $path = '';
        if (!$region) {
            $region = 213;
        }
        
        $path = "?lr=".$region;
        $url = 'http://xmlsearch.yandex.ru/xmlsearch'.$path;
        return $url;
    }

    /**
     * Parsing Yandex Xml string
     * @param SimpleXMLElement $response response YanderXML
     * @param string $url_comp  url Р Т‘Р В»РЎРЏ РЎРѓРЎР‚Р В°Р Р†Р Р…Р ВµР Р…Р С‘РЎРЏ
     * @return array (z_Seo, z_Seocomp)
     */
    private function parsed($response){

        $positions = array();
        $pos       = 0;
        $groups    = $response->results->grouping->group;
        $i         = 0;
        $ps;

        
        foreach($groups as $value){
            $pos++;
            $ps['pos'] = $pos;

            $url = (string) $value->doc->url;
            $parsedUrl = @parse_url($url);
            $ps['site'] = $parsedUrl['host'];//
            $ps['url'] = $url;
            $ps['links_search'] = (string) $value->doc->properties->_PassagesType;//Р Р…Р В°Р в„–Р Т‘Р ВµР Р…Р С• Р С—Р С• РЎРѓРЎРѓРЎвЂ№Р В»Р С”Р Вµ
            $positions[md5($url)] = $ps;
        }

        return $positions;
    }

    protected function parsing(Keywords $k, $dot = false){

        $query = $this->setQuery($k->name);
        $query .= $dot ? '.' : '';
        $depth = 1;
        $finded = false;
        $pos = array();
        for ($page = 0; $page < $depth; $page++){

            $this->curl_opt[CURLOPT_INTERFACE] = $this->getIp();
            $this->curl_opt[CURLOPT_POSTFIELDS] = 'text='.$this->getXMLRequest($query, $page);
            $xml_response = $this->request();
           
            $attempts = 2;// +2 Р С—Р С•Р С—РЎвЂ№РЎвЂљР С”Р С‘
            while(empty($xml_response) && $attempts!=0){
                $this->curl_opt[CURLOPT_INTERFACE] = $this->getIp();
                var_dump('Р Р‡Р Р…Р Т‘Р ВµР С”РЎРѓ Р Р…Р Вµ Р С•РЎвЂљР Р†Р ВµРЎвЂљР С‘Р В», Р С