<?php
namespace JSomerstone\Cimbic\View;
use JSomerstone\Cimbic\Exception\SiteException as SiteException;

class ShowPage extends CoreView
{
    public $request;
    public $debug;

    /**
     * Template engine Dwoo -controller
     * @var \Dwoo
     */
    protected $templateController;

    protected $templateFile;

    /**
     * Initializes template controller Dwoo and sets default template/layout
     * @param string $sitePath
     */
    public function __construct($sitePath, $baseUrl)
    {
        parent::__construct($sitePath);
        $this->prefillData();

        $this->setBaseUrl($baseUrl);

        $this->templateController = new \Dwoo();
        $this->setTemplate($this->template);
    }

    /**
     * Prefills views data to avoid exceptions about undefined indexes
     */
    protected function prefillData()
    {
        $this->data = array(
            'content' => null,
            'siteTitle' => '',
            'cssList' => array(),
            'layout' => 'default.tpl'
        );
    }

    /**
     * Sets the views layout
     *
     * In order to work Site's Layout must have .tpl file in path
     * Public/Template/<nameOfTemplate>/Layout/$layoutName.tpl
     * @param string $layoutName
     * @throws SiteException if given layout is not found from sites template
     */
    public function setLayout($layoutName)
    {
        $templateLocation = sprintf('%s/Public/Template/%s/Layout/%s.tpl',
                $this->sitePath, $this->template, $layoutName );
        if (!file_exists($templateLocation))
        {
            throw new SiteException(
                sprintf("Unable to locate layout '%s' from template '%s' of site '%s'",
                    $layoutName, $this->template, $this->sitePath
                )
            );
        }
        $this->set('layout', $layoutName . '.tpl');
    }

    /**
     * Sets the views template
     * @param string $templateName
     * @throws SiteException when given template is not found from site
     */
    public function setTemplate($templateName)
    {
        $templateLocation = sprintf('%s/Public/Template/%s/index.tpl',
                $this->sitePath, $templateName );
        if (!file_exists($templateLocation))
        {
            throw new SiteException("Unable to locate 'index.tpl' from site '$this->sitePath'");
        }
        $this->template = $templateName;
        $this->templateFile = new \Dwoo_Template_File($templateLocation);
    }

    public function setBaseUrl($baseUrl)
    {
        $this->set('baseUrl', $baseUrl);
    }

    /**
     * Prints the tamplate filled with data
     * @return void
     */
    public function printOutput()
    {
        $this->templateController->output(
            $this->templateFile,
            $this->data
        );
    }

    /**
     * Adds a CSS-link to be printed into <head> section of output
     * @param string $file Path to CSS-file. For example 'css/typeface.css'
     * @param string $media optional "media"-attribute of CSS-link, for example 'screen'
     */
    public function addCss($file, $media = 'all')
    {
        if (!isset($this->data['cssList']))
        {
            $this->data['cssList'] = array();
        }
        $this->data['cssList'][] = array(
            'file' => $file,
            'media' => $media
        );
    }

    /**
     * Add single js-file to view setting jsList
     * @param string|array $file relative path to .js file or array of them
     */
    public function addJavaScript($file)
    {
        if (!isset($this->data['jsList']))
        {
            $this->data['jsList'] = array();
        }
        if (is_array($file))
        {
            foreach ($file as $aScript)
            {
                $this->addJavaScript($aScript);
            }
        }
        else
        {
            $this->data['jsList'][] = array('file' => $file);
        }
    }
}