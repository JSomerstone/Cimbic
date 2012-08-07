<?php
namespace JSomerstone\Cimbic\View;

class Json extends CoreView
{
    public $data;

    public function __toString()
    {
        return json_encode($this->data);
    }
}