<?php
namespace JSomerstone\Cimbic\View;

class File extends \JSomerstone\Cimbic\Core\View
{

    private $fileHandle;
    private $filePath;

    public function __construct($sitePath, $filePath = null)
    {
        parent::__construct($sitePath);
        $this->filePath = $filePath;
    }

    public function openFile($filePath)
    {
        $absolutePath = $this->sitePath . '/' .$filePath;

        $this->fileHandle = fopen($absolutePath, 'r');
    }

    public function printOutput()
    {
        //TODO : loop throug fileHandle and output the content of file
    }
}
