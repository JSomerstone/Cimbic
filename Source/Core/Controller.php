<?php
namespace JSomerstone\Cimbic\Core;

class Controller extends \JSomerstone\JSFramework\Controller
{
    protected $sitePath = '';
    protected $baseUrl = '';
    protected $template = 'default';

    public function __construct(
        $sitePath,
        $baseUrl,
        \JSomerstone\JSFramework\Request $requestObject,
        \JSomerstone\JSFramework\View $viewObject = null
    )
    {
        parent::__construct($requestObject, $viewObject);
        $this->sitePath = $sitePath;
        $this->baseUrl = $baseUrl;
    }

    /**
     * Overrides controllers view and shows 404-page
     */
    protected function _404()
    {
        $this->view->setErrorCode(\JSomerstone\JSFramework\View::ERROR_CODE_NOT_FOUND);
        $contentPath = sprintf(
            '%s/ErrorPages/404.htm',
            dirname(__DIR__)
        );
        $this->view->set('siteTitle', 'Requested file not found');
        $this->view->set('content', file_get_contents($contentPath));
    }

}