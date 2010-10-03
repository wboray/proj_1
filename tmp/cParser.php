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
        //Р Т‘Р С•Р В±Р В°Р Р†Р В»РЎРЏР ВµР С