<?php
namespace JSomerstone\Cimbic\View;

class File extends CoreView
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
        if ($this->get('contentType'))
        {
            $this->setHeader(
                'Content-Type',
                $this->get('contentType')
            );
        }
        if ($this->get('fileName'))
        {
            $this->setHeader(
                'Content-Disposition',
                'attachment; filename=' . $this->get('fileName')
            );
        }
        if ($this->get('fileType'))
        {
            $this->setHeader(
                'Content-Type',
                $this->get('fileType')
            );
        }
        //NativeFunctions::header("Content-Type: application/zip");
        //NativeFunctions::header("Content-Transfer-Encoding: binary");
    }

    public function printOutput()
    {
        echo $this->get('content');
    }
}
