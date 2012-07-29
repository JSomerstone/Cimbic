<?php
namespace JSomerstone\Cimbic\Controller;

class Resource extends \JSomerstone\Cimbic\Core\Controller
{
    public function setup()
    {
        $this->view = new \JSomerstone\Cimbic\View\File($this->sitePath);
    }

    /**
     * somerkivi.net/Resource/css/styles.css
     */
    public function css()
    {
        $requestedFileHierarchy = $this->request->getRequestPath();
        $requestedPagePath = sprintf(
                '%s/Template/%s/css/%s.css',
                $this->sitePath,
                $this->template,
                implode('/', $requestedFileHierarchy)
        );

    }

    public function js()
    {
        $requested = $this->request->getURI('css');

    }
}