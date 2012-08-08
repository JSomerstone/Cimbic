<?php
namespace JSomerstone\Cimbic\Model;

class JsFile extends \JSomerstone\Cimbic\Core\Model implements FileModelInterface
{
    protected $filePath = '';
    protected $fileName = '';

    public function __construct($file)
    {
        $filePath = sprintf(
            '%s/3rdParty/%s.js',
            dirname(__DIR__),
            $file
        );

        $this->filePath = $filePath;
        $this->fileName = basename($filePath);
    }

    public function isOk()
    {
        return file_exists($this->filePath) && is_readable($this->filePath);
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function getFileContent()
    {
        return file_get_contents($this->filePath);
    }

    public function getFileType()
    {
        $fileInfo = new \finfo(FILEINFO_MIME);
        return $fileInfo->file($this->filePath);
    }

    public static function scanDirForJsFiles($pathToScan)
    {
        $fileList = scandir($pathToScan);
        foreach ($fileList as $i => $scriptFile)
        {
            //Include all .css files, exclude other
            if (preg_match('/.js$/i', $scriptFile)){
                $fileList[$i] = $scriptFile;
            } else {
                unset($fileList[$i]);
            }

        }
        return $fileList;
    }
}