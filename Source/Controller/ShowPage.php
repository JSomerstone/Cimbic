<?php
namespace JSomerstone\Cimbic\Controller;

class ShowPage extends \JSomerstone\Cimbic\Core\Controller
{
    protected function setup()
    {
        $this->view = new \JSomerstone\Cimbic\View\ShowPage(
            $this->sitePath,
            $this->baseUrl
        );

        $this->view->set('request', $this->request);
    }

    /**
     * Commit given action
     * @param string $actionName
     */
    protected function commitAction($actionName)
    {
        $this->index();
    }

    public function index()
    {
        $this->view->set('siteTitle', 'Front page');
        $this->applyCss();
        $requestedPageHierarchy = $this->request->getRequestPath();
        $requestedPagePath = sprintf(
                '%s/Content/%s.htm',
                $this->sitePath,
                implode('/', $requestedPageHierarchy)
        );

        if (empty($requestedPageHierarchy))
        {
            $this->_frontPage();
        } elseif (file_exists($requestedPagePath)) {
            $this->setContent(file_get_contents($requestedPagePath));
        } else {
            $this->_404();
        }

    }

    public function applyCss()
    {
        //Apply Blueprint CSSes
        $this->view->addCss('StaticFile/css/blueprint/screen', 'screen, projection');
        $this->view->addCss('StaticFile/css/blueprint/print', 'print');


        $templateCss = $this->getListOfTemplateCssFiles();
        foreach ($templateCss as $aCss)
        {
            $this->view->addCss(
                sprintf('Template/%s/css/%s.css',
                $this->template,
                $aCss
            ));
        }
    }

    /**
     * Scans current templates css-folder and returns list of css files
     * @return array List of CSS-files
     */
    private function getListOfTemplateCssFiles()
    {
        $cssPath = sprintf(
                '%s/Public/Template/%s/css/',
                $this->sitePath,
                $this->template
        );
        return \JSomerstone\Cimbic\Model\CssFile::scanDirForCssFiles($cssPath);
    }

    private function setContent($pageContent)
    {
        $this->view->set('content', $pageContent);
    }

    private function _frontPage()
    {
        $frontPagePath = sprintf(
            '%s/Content/frontpage.htm',
            $this->sitePath
        );
        $this->setContent(file_get_contents($frontPagePath));
    }
}