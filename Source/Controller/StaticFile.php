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

    public function js()
    {
        //Get request path after Controller/action
        $requestPath = $this->request->getRequestPath(2);
        $fileModel = new \JSomerstone\Cimbic\Model\JsFile(
            implode('/', $requestPath)
        );
        if ($fileModel->isOk())
        {
            $this->view->setAssoc(array(
                'contentType'   => 'text/javascript',
                'fileType'      => $fileModel->getFileType(),
                'fileName'      => $fileModel->getFileName(),
                'content'       => $fileModel->getFileContent(),
            ));
        }
        else
        {
            $this->_404();
        }
    }

    public function css()
    {
        //Get request path after Controller/action
        $requestPath = $this->request->getRequestPath(2);
        $fileModel = new \JSomerstone\Cimbic\Model\CssFile(
            implode('/', $requestPath)
        );
        if ($fileModel->isOk())
        {
            $this->view->setAssoc(array(
                'contentType'   => 'text/css',
                'fileType'      => $fileModel->getFileType(),
                'fileName'      => $fileModel->getFileName(),
                'content'       => $fileModel->getFileContent(),
            ));
        }
        else
        {
            $this->_404();
        }
    }
}