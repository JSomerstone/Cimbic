<?php
defined('TIMEZONE') OR define('TIMEZONE', 'Europe/Helsinki');
date_default_timezone_set(TIMEZONE);

defined('DS') OR define('DS', DIRECTORY_SEPARATOR);
defined('NL') OR define('NL', "\n");


function autoloadClass($className)
{

    $namespaceParts = explode('\\', $className);

    if (in_array($namespaceParts[0], array('JSomerstone\Cimbic', 'JSFramework')))
    {
        unset($namespaceParts[0]);
    }
    $pathToFile = implode(DS, $namespaceParts) . '.php';

    /*if (!file_exists($pathToFile))
    {
        die (sprintf("Unable to find class '%s' from '%s' with include path %s",
            $className, $pathToFile, get_include_path()));
    }*/

    require_once $pathToFile;
}

spl_autoload_register("autoloadClass");

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
