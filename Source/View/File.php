<?php
namespace JSomerstone\Cimbic\View;

class File extends \JSomerstone\Cimbic\Core\View
{
    /**
     * Outputs HEADERS and CONTENT
     * Overrides JSomerstone\JSFramework\View::output()
     */
    public function output()
    {
        $this->_setHeaderAccordingToErrorCode();
        $this->_setFileHeaders();
        $this->printOutput();
    }

    private function _setFileHeaders()
    {
        $fileModel = $this->get('model');
        //D($fileModel->getFileName(), $fileModel->getFileType());
        // Set headers
        $this->setHeader(
            'Content-Disposition',
            'attachment; filename=' . $fileModel->getFileName()
        );
        $this->setHeader(
            'Content-Type',
            $fileModel->getFileType()
        );
        //NativeFunctions::header("Content-Type: application/zip");
        //NativeFunctions::header("Content-Transfer-Encoding: binary");
    }

    public function printOutput()
    {
        $fileModel = $this->get('model');
        echo $fileModel->getFileContent();
    }
}
