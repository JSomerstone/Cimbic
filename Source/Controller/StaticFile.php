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
        //Get request path after Controller/action
        $requestPath = $this->request->getRequestPath(2);
        $fileModel = new \JSomerstone\Cimbic\Model\CssFile(
            implode('/', $requestPath)
        );

        if (!$fileModel->isOk())
        {
            $this->view->setErrorCode(\JSomerstone\JSFramework\View::ERROR_CODE_NOT_FOUND);
        }
        else
        {
            $this->view->setAssoc(array(
                'contentType' =>  'text/css',
                'content', $fileModel->getFileContent(),
                'fileType', $fileModel->getFileType(),
                'fileName', $fileModel->getFileName()
            ));
        }
    }
}