<?php
namespace JSomerstone\Cimbic;

class ContentManager
{
    /**
     * A Controller-object based on Request
     * @var \JSomerstone\JSomerstone\Cimbic\Controller
     */
    private $controller;

    /**
     * A Request object
     * @var \JSomerstone\JSFramework\Request
     */
    private $request;

    private $sitePath;


    public function __construct($sitePath)
    {
        if (!file_exists($sitePath))
        {
            die('Unable to find content');
        }
        $this->sitePath = $sitePath;
    }

    public function execute()
    {
        $this->request = new Request();
        $this->controller = $this->_getControllerByName($this->request->getController());
        $this->controller->run();
    }

    private function _getControllerByName($controllerName = null)
    {
        $controllerClass = sprintf('\JSomerstone\Cimbic\Controller\%s', $controllerName);
        $controllerFile = sprintf('JSomerstone/Cimbic/Controller/%s.php', $controllerName);

        //Some controller required, initialize it if exists
        if (
            !empty($controllerName)
            && file_exists($controllerFile)
            && class_exists($controllerClass)
        ) {
            return new $controllerClass($this->sitePath, $this->request);
        } else {
        //Assume show page reguest
            return new Controller\ShowPage($this->sitePath, $this->request);
        }
    }
}