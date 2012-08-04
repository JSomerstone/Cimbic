<?php
namespace JSomerstone\Cimbic\Controller;
use \JSomerstone\JSFramework\Exception\NotFoundException as NotFoundException;

class StaticFile extends \JSomerstone\Cimbic\Core\Controller
{
    protected function setup()
    {
        $this->view = new \JSomerstone\Cimbic\View\File($this->sitePath);
        $this->view->setHeader('Cache-Control', 'public');
        $this->view->setHeader('Content-Description', 'File Transfer');
    }

    public function css()
    {
        $this->view->set('contentType', 'text/css');
        //Get request path after Controller/action
        $requestPath = $this->request->getRequestPath(2);
        try
        {
            $fileModel = new \JSomerstone\Cimbic\Model\CssFile(
                implode('/', $requestPath)
            );
            $this->view->set('model', $fileModel);
        }
        catch (NotFoundException $e)
        {
            return $this->_404();
        }

    }
}