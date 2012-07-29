<?php
namespace JSomerstone\Cimbic\View;

class ShowPage extends \JSomerstone\Cimbic\Core\View
{
    public $pageID = null;
    public $request;
    public $debug;

    /**
     * Template engine Dwoo -controller
     * @var \Dwoo
     */
    protected $templateController;

    protected $templateFile;


    public function __construct($sitePath)
    {
        $this->sitePath = $sitePath;
        $this->templateController = new \Dwoo();
        $this->setTemplate($this->template);
    }

    public function setTemplate($templateName)
    {
        $templateLocation = sprintf('%s/Template/%s/skeleton.tpl',
                $this->sitePath, $templateName );
        $this->template = $templateName;
        $this->templateFile = new \Dwoo_Template_File($templateLocation);
    }

    public function printOutput()
    {
        return $this->templateController->get(
            $this->templateFile,
            $this->data
        );
    }

    private function _printDebug()
    {
        return sprintf('<div id="debugContainer">%s<hr>%s</div>',
            nl2br(var_export($this->request->getGet(), true)),
            nl2br(var_export($this->request->getPost(), true))
        );
    }
}