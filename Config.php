<?php
/* 
 * ПОдключение необходимых файлов и общая настройка
 */
error_reporting(2047);

/*
 * fix me
 * разграничить эти настроки для демона и недемона. т.к. такие лимиты только демонам нужны
 */
//
@ini_set ('pcre.backtrack_limit', '5000000');
@ini_set('max_execution_time',0);
@ini_set("max_input_time",0);
@set_time_limit(0);
header('Content-type: text/html; charset=utf-8');
define ('DIR_PATH', str_replace("\\", "/", realpath (dirname (__FILE__))));

$dirs [] = '.';
$dirs [] = DIR_PATH . '/Common';
$dirs [] = DIR_PATH . '/DB';
$dirs [] = DIR_PATH . '/Interfaces';
$dirs [] = DIR_PATH . '/Commands';
$dirs [] = DIR_PATH . '/Registry';
$dirs [] = DIR_PATH . '/Models';
$dirs [] = DIR_PATH . '/Views';
$dirs [] = DIR_PATH . '/Templates';

set_include_path(implode(PATH_SEPARATOR, $dirs));

require_once 'RunTimer.php';
require_once 'Log.php';
require_once 'TFormat.php';
require_once 'RegistryRequest.php';
require_once 'RegistryContext.php';
require_once 'RegistryDb.php';
$timer = new RunTimer();

Log::setLevel(1);

require_once 'DBParsingInterface.php';
require_once 'DBCheckingInterface.php';

require_once 'Front.php';
require_once 'DB.php';
require_once DIR_PATH . '/Lang/ru/texts.php';
$request = RegistryRequest::instance();
$context = RegistryContext::instance();
$context->set('error', false);
RegistryDb::instance()->setSettings('default', array('localhost', 'nindex_user', 'MINI!index', 'newindex'));
DB::connect();
        if ($request->is('deamon')) {
            $cmd = Front::getCommand($request);
            $cmd->execute($request);
        } else if ($request->is('view')) {
            $view = Front::getView($request);
            $view->execute($context);
        } else {
            $request->set('view', 'first');
            $view = Front::getView($request);
            $view->execute($context);
        }

?>
