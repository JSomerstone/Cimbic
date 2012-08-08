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
        $this->setSiteSettings();
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
        $this->applyCss();
        $requestedPageHierarchy = $this->request->getRequestPath();
        $requestedPagePath = $this->getRequestedPagePath();

        if (empty($requestedPageHierarchy))
        {
            $this->_frontPage();
        } elseif (file_exists($requestedPagePath)) {
            $this->setContent(file_get_contents($requestedPagePath));
            $this->setPageSettings($this->getPageSettings($requestedPageHierarchy));
        } else {
            $this->_404();
        }
    }

    private function getRequestedPagePath()
    {
        $requestedPageHierarchy = $this->request->getRequestPath();
        $requestedPagePath = sprintf(
                '%s/Content/%s.htm',
                $this->sitePath,
                implode('/', $requestedPageHierarchy)
        );
        return $requestedPagePath;
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

    private function setSiteSettings()
    {
        $settings = $this->getSiteSettings();
        $this->view->setAssoc($settings);
    }

    private function setPageSettings(array $settings)
    {
        $this->view->setAssoc($settings);
        if (isset($settings['pageTitle']))
        {
            $this->view->set('siteTitle', sprintf(
                '%s - %s',
                $settings['pageTitle'],
                $this->view->get('siteTitle')
            ));
        }
    }

    private function _frontPage()
    {
        $frontPagePath = sprintf(
            '%s/Content/frontpage.htm',
            $this->sitePath
        );
        $this->setContent(file_get_contents($frontPagePath));
        $this->setPageSettings($this->getPageSettings(array('frontpage')));
    }

    /**
     * Reads settings for requested page
     * Settings are stored in <site>/Content/<requested/page>.json
     * @param array $requestedPath Path to requested page as array
     * @return array
     */
    private function getPageSettings(array $requestedPath)
    {
        $requestedPagePath = sprintf(
                '%s/Content/%s.json',
                $this->sitePath,
                implode('/', $requestedPath)
        );

        if (file_exists($requestedPagePath) && is_readable($requestedPagePath))
        {
            $settings = json_decode(file_get_contents($requestedPagePath), true);
            if (!empty($settings))
            {
                return $settings;
            }
            else
            {
                return array();
            }
        }
        else
        {
            return array();
        }
    }
}