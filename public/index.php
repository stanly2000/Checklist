<?php
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
// for now it the same that the ROOT one in the future this better be separated
define('APP', dirname(__DIR__) . DIRECTORY_SEPARATOR);

error_reporting(E_ALL);
ini_set("display_errors", 1);
//echo "<br>index.php<br> ".'$_GET=';



require_once ROOT.'core/appStart.php';

$app = new App;
