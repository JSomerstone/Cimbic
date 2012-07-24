<?php
namespace JSomerstone\Cimbic\Core;

class Controller extends \JSomerstone\JSFramework\Controller
{
    protected $sitePath = '';

    public function __construct(
        $sitePath,
        \JSomerstone\JSFramework\Request $requestObject,
        \JSomerstone\JSFramework\View $viewObject = null
    )
    {
        parent::__construct($requestObject, $viewObject);
        $this->sitePath = $sitePath;
    }

}