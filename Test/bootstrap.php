<?php
require_once 'Debug.php';

passthru('clear');

defined('TIMEZONE') OR define('TIMEZONE', 'Europe/Helsinki');
date_default_timezone_set(TIMEZONE);

defined('DS') OR define('DS', DIRECTORY_SEPARATOR);
defined('NL') OR define('NL', "\n");

defined('SITE_PATH_PREFIX') OR define('SITE_PATH_PREFIX', 'sites/fakesites.net');

addIncludePath(dirname(__DIR__) . '/Source');
loadMock('NativeFunctions');

function testAutoloadClass($className)
{
    $underscoredClassName = str_replace(array('\\'), '_', $className);

    if (substr($className, 0, 4) === 'Dwoo')
    {
        require_once '3rdParty/Dwoo/' . strtr($className, '_', DS).'.php';
    }
    else if (preg_match('/^JSomerstone_Cimbic_Test_/', $underscoredClassName))
    {
        $className = preg_replace('/^JSomerstone_Cimbic_Test_/', '', $underscoredClassName);
        require_once str_replace(array('\\', '_'), DS, $className) . '.php';
    }
    else
    {
        require_once str_replace(array('\\', '_'), DS, $className) . '.php';
    }
}

spl_autoload_register("testAutoloadClass");



function loadMock($className)
{
     $mockClassFile = 'Mock/' . str_replace(array('\\', '_'), DS, $className) . '.php';
     require_once $mockClassFile;
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

function addIncludePath ($path)
{
    foreach (func_get_args() AS $path)
    {
        if (!file_exists($path) OR (file_exists($path) && filetype($path) !== 'dir'))
        {
            trigger_error("Include path '{$path}' not exists", E_USER_WARNING);
            continue;
        }

        $paths = explode(PATH_SEPARATOR, get_include_path());

        if (array_search($path, $paths) === false)
            array_push($paths, $path);

        set_include_path(implode(PATH_SEPARATOR, $paths));
    }
}

function removeIncludePath ($path)
{
    foreach (func_get_args() AS $path)
    {
        $paths = explode(PATH_SEPARATOR, get_include_path());

        if (($k = array_search($path, $paths)) !== false)
            unset($paths[$k]);
        else
            continue;

        if (!count($paths))
        {
            trigger_error("Include path '{$path}' can not be removed because it is the only", E_USER_NOTICE);
            continue;
        }

        set_include_path(implode(PATH_SEPARATOR, $paths));
    }
}