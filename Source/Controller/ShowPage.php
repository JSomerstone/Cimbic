<?php
namespace JSomerstone\Cimbic\Controller;

class ShowPage extends \JSomerstone\Cimbic\Core\Controller
{
    protected function setup()
    {
        $this->view = new \JSomerstone\Cimbic\View\ShowPage($this->sitePath);

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

    private function _404()
    {
        $this->view->setErrorCode(\JSomerstone\JSFramework\View::ERROR_CODE_NOT_FOUND);
        $contentPath = sprintf(
            '%s/ErrorPages/404.htm',
            dirname(__DIR__)
        );
        $this->setContent(file_get_contents($contentPath));
    }
}