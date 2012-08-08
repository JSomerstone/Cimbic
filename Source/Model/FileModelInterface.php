<?php
namespace JSomerstone\Cimbic\Model;

interface FileModelInterface
{
    public function getFileName();

    public function getFileContent();

    public function getFileType();

    public function isOk();

}