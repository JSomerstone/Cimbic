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
        $this->applyJavascripts();

        $requestedPageHierarchy = $this->request->getRequestPath();
        $requestedPagePath = $this->getRequestedPagePath();

        if (empty($requestedPageHierarchy))
        {
            $this->_frontPage();
        } elseif (file_exists($requestedPagePath)) {
            $this->setContent(file_get_contents($requestedPagePath));
            $this->setPageSettings();

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

    private function applyJavascripts()
    {
        $this->view->addJavaScript($this->getSiteJavascripts());
    }

    public function getSiteJavascripts()
    {
        $jsPath = sprintf(
                '%s/Public/js/',
                $this->sitePath
        );
        $jsList = \JSomerstone\Cimbic\Model\JsFile::scanDirForJsFiles($jsPath);
        foreach ($jsList as $i => $jsFile)
        {
            $jsList[$i] = 'js/' . $jsFile;
        }
        return $jsList;
    }

    public function applyCss()
    {
        //Apply Blueprint CSS'es
        $this->view->addCss('cimbic/css/blueprint/screen.css', 'screen, projection');
        $this->view->addCss('cimbic/css/blueprint/print.css', 'print');
        //Apply jQuery-UI's CSS'es
        $this->view->addCss('cimbic/css/dark-hive/jquery-ui.css', 'all');


        $siteCss = $this->getListOfSiteCssFiles();
        foreach ($siteCss as $aCss)
        {
            $this->view->addCss(
                sprintf('css/%s.css',
                $aCss
            ));
        }

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

    /**
     * Scans current sites css-folder and returns list of css files
     * @return array List of CSS-files
     */
    private function getListOfSiteCssFiles()
    {
        $cssPath = sprintf(
                '%s/Public/css/',
                $this->sitePath
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

    private function setPageSettings(array $settings = null)
    {
        if (is_null($settings))
        {
            $settings = $this->getPageSettings($this->request->getRequestPath());
        }
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
        $settings = array();
        if (file_exists($requestedPagePath) && is_readable($requestedPagePath))
        {
            $settings = json_decode(file_get_contents($requestedPagePath), true);
        }
        return $settings;
    }

    /**
     * Return true if editing is allowed for current user
     * @return bool
     */
    private function editingIsAllowed()
    {
        return $this->request->getUri('edit') ? true : false;
    }
}