<?php
namespace JSomerstone\Cimbic\Model;

class CssFile extends \JSomerstone\Cimbic\Core\Model implements FileModelInterface
{
    protected $filePath = '';
    protected $fileName = '';

    public function __construct($file)
    {
        $filePath = sprintf(
            '%s/Css/%s.css',
            dirname(__DIR__),
            $file
        );
        if (!file_exists($filePath))
        {
            throw new \JSomerstone\JSFramework\Exception\NotFoundException(
                "Css file '$file' was not found from '$filePath'"
            );
        }

        $this->filePath = $filePath;
        $this->fileName = basename($filePath);
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

    public static function scanDirForCssFiles($cssPath)
    {
        $cssList = scandir($cssPath);
        foreach ($cssList as $i => $aCssFile)
        {
            //Include all .css files, exclude other
            if (preg_match('/.css$/i', $aCssFile)){
                $cssList[$i] = substr($aCssFile, 0, -4);
            } else {
                unset($cssList[$i]);
            }

        }
        return $cssList;
    }
}