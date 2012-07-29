<?php
namespace JSomerstone\Cimbic\Core;
abstract class View extends \JSomerstone\JSFramework\View
{
    protected $template = 'default';
    protected $sitePath;

    public function __construct($sitePath)
    {
        $this->sitePath = $sitePath;
    }
}