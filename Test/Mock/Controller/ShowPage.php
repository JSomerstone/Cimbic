<?php
namespace JSomerstone\Cimbic\Controller;

class ShowPage extends \JSomerstone\Cimbic\Test\Mock\MockClass
{
    public function __construct()
    {
        $this->__saveCalled('__construct', func_get_args());
    }
}