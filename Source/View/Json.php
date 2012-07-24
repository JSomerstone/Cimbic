<?php
namespace JSomerstone\Cimbic\View;

class Json extends \JSomerstone\Cimbic\Core\View
{
    public $data;

    public function __toString()
    {
        return json_encode($this->data);
    }
}