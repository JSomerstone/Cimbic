<?php
namespace JSomerstone\Cimbic\View;
abstract class CoreView extends \JSomerstone\JSFramework\View
{
    protected $template = 'default';
    protected $sitePath;

    public function __construct($sitePath)
    {
        $this->sitePath = $sitePath;
    }
}