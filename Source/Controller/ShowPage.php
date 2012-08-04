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
        $templateCss = $this->getListOfTemplateCssFiles();
        foreach ($templateCss as $aCss)
        {
            $this->view->addCss($aCss);
        }
    }

    private function getListOfTemplateCssFiles()
    {
        $cssPath = sprintf(
                '%s/Public/Template/%s/css/',
                $this->sitePath,
                $this->template
        );

        $cssList = scandir($cssPath);
        foreach ($cssList as $i => $aCssFile)
        {
            if (preg_match('/.css$/i', $aCssFile)){
                $cssList[$i] = substr($aCssFile, 0, -4);
            } else {
                unset($cssList[$i]);
            }

        }
        return $cssList;
    }

    private function setContent($pagePath)
    {
        $this->view->set('content', $pagePath);
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