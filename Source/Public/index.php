<?php
include __DIR__.'/../autoloader.php';

addIncludePath('/Users/joonasomerkivi/work/JSFramework/Source');
addIncludePath(dirname(__DIR__));

define('SITE_PATH_PREFIX', 'somerkivi.net');

$contentManager = new JSomerstone\Cimbic\ContentManager();

$contentManager->execute();