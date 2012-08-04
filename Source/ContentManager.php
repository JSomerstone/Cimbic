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
    private $baseUrl;

    public function __construct($sitePath, $baseUrl = '')
    {
        if (!file_exists($sitePath))
        {
            die('Unable to find content');
        }
        $this->baseUrl = $this->formBaseUrl($baseUrl);
        $this->sitePath = $sitePath;
    }

    /**
     * Form base url <http(s)>://<host>/$baseUrl/
     * @param string $baseUrl
     * @return string URL
     */
    private function formBaseUrl($baseUrl = '')
    {
        return sprintf(
            '%s://%s/%s/',
            (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != "off") ? "https" : "http",
            $_SERVER['HTTP_HOST'],
            $baseUrl
        );
    }

    public function execute(Request $requestObj = null)
    {
        $this->request = is_null($requestObj)
                    ? new Request()
                    : $requestObj;

        $this->controller = $this->_getControllerByName($this->request->getController());
        $this->controller->run();
    }

    private function _getControllerByName($controllerName = null)
    {
        $controllerClass = sprintf('\JSomerstone\Cimbic\Controller\%s', $controllerName);
        $controllers = $this->getControllerList();

        //Some controller required, initialize it if exists
        if (
            !empty($controllerName)
            && in_array($controllerName, $controllers)
            && @class_exists($controllerClass)
        ) {
            return new $controllerClass($this->sitePath, $this->baseUrl, $this->request);
        } else {
            //Assume show page reguest
            return new Controller\ShowPage($this->sitePath, $this->baseUrl, $this->request);
        }
    }

    /**
     * Scans Controller -folder and returns the name of each .php file as array
     * @return array List of controllers in Controller-folder
     */
    private function getControllerList()
    {
        $controllers = scandir(__DIR__ . '/Controller/');
        foreach ($controllers as $i => $controller)
        {
            if (preg_match('/^[A-z0-9]+.php/i', $controller)){
                $controllers[$i] = substr($controller, 0, -4);
            } else {
                unset($controllers[$i]);
            }

        }
        return $controllers;
    }
}