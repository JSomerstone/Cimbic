<?php
namespace JSomerstone\Cimbic;

class ContentManager
{
    /**
     * A Controller-object based on Request
     * @var \JSomerstone\Cimbic\Controller
     */
    private $controller;

    /**
     * A Request object
     * @var \JSFramework\Request
     */
    private $request;


    public function execute()
    {
        $this->request = new \JSFramework\Cimbic\Request();
        $this->controller = $this->_getControllerByName($this->request->getController());
        $this->controller->run();
    }

    private function _getControllerByName($controllerName)
    {
        $controllerClass = sprintf('\JSomerstone\Cimbic\Controller\%s', $controllerName);
        if (empty($controllerName)) //Without controller, use default
        {
            return new Controller\ShowPage($this->request);
        }
        //Some controller required, initialize it if exists
        else if (class_exists($controllerClass))
        {
            return new $controllerClass($this->request);
        }
        //Unknown controller, user Exception-controller
        else
        {
            return new Controller\Exception($this->request);
        }
    }
}