<?php
passthru('clear');
//require_once '../Source/cimbicAutoloader.php';
defined('TIMEZONE') OR define('TIMEZONE', 'Europe/Helsinki');
date_default_timezone_set(TIMEZONE);

defined('DS') OR define('DS', DIRECTORY_SEPARATOR);
defined('NL') OR define('NL', "\n");

loadMock('NativeFunctions');

function testAutoloadClass($className)
{
    $underscoredClassName = str_replace(array('\\'), '_', $className);

    if (substr($className, 0, 4) === 'Dwoo') {
        require_once 'Dwoo' . DS . strtr($className, '_', DS).'.php';
    } else if (preg_match('/^JSomerstone_Cimbic_Test_/', $underscoredClassName)) {
        $className = preg_replace('/^JSomerstone_Cimbic_Test_/', '', $underscoredClassName);
        require_once str_replace(array('\\', '_'), DS, $className) . '.php';
    } else {
        require_once str_replace(array('\\', '_'), DS, $className) . '.php';
    }
}

spl_autoload_register("testAutoloadClass");

function D()
{
    foreach (func_get_args() AS $debug)
    {
        var_dump($debug);
    }
}

function DE()
{
    foreach (func_get_args() AS $debug)
    {
        var_dump($debug);
    }
    exit(0);
}

function loadMock($className)
{
     $mockClassFile = 'Mock/' . str_replace(array('\\', '_'), DS, $className) . '.php';
     include_once $mockClassFile;
}

function rcopy($src, $dst) {
  if (file_exists($dst)) rrmdir($dst);
  if (is_dir($src)) {
    mkdir($dst);
    $files = scandir($src);
    foreach ($files as $file)
    if ($file != "." && $file != "..") rcopy("$src/$file", "$dst/$file");
  }
  else if (file_exists($src)) copy($src, $dst);
}
function rrmdir($dir) {
  if (is_dir($dir)) {
    $files = scandir($dir);
    foreach ($files as $file)
    if ($file != "." && $file != "..") rrmdir("$dir/$file");
    rmdir($dir);
  }
  else if (file_exists($dir)) unlink($dir);
}
