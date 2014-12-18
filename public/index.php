<?php
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
// for now it the same that the ROOT one in the future this better be separated
define('APP', dirname(__DIR__) . DIRECTORY_SEPARATOR);


define ( 'RESOURCE' ,'http://' .$_SERVER['HTTP_HOST']. str_replace($_SERVER['DOCUMENT_ROOT'], '',str_replace('\\', '/', dirname(__DIR__).'/public')));


error_reporting(E_ALL);
ini_set("display_errors", 1);
//echo "<br>index.php<br> ".'$_GET=';



require_once ROOT.'core/appStart.php';

$app = new App;
