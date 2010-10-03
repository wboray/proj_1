<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cParser
 *
 * @author asuslov
 */

require_once 'Command.php';
require_once 'RegistryParser.php';
require_once 'DBParserYandexXml.php';
require_once DIR_PATH . '/Daemons/dClasses/Parser.php';

class cParser extends Command {

    function  execute(RegistryRequest $request) {
        include_once DIR_PATH . '/Daemons/dClasses/ParserYandexXml.php';
        $config = RegistryParser::instance();
        //добавляем настройки
        if ($request->get('type') == 'reset') {
            include DIR_PATH . '/Daemons/ParserReset.php';
        } else {
            $config->set('parserType', $request->get('type'));
            $config->set('db', new DBParserYandexXml());
            $parser = self::getParser($config);
            $parser->run($config);
        }
        
    }
    protected static function getParser(RegistryParser $config){
        return new ParserYandexXml($config);
    }
    function  __construct() {

    }
}