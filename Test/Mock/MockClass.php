<?php
namespace JSomerstone\Cimbic\Test\Mock;

class MockClass
{
    public $callStack = array();

    protected function __saveCalled($method, $parameters)
    {
        $this->callStack[] = array(
            'method' => $method,
            'parameters' => $parameters
        );
    }
}