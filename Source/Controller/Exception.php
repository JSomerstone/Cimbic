<?php

namespace JSomerstone\Cimbic\Controller;

class Exception extends \JSomerstone\Cimbic\Core\Controller
{
    public function setup()
    {
        $this->setView(new \JSomerstone\Cimbic\View\Json());
    }

    public function index()
    {
        $this->view->set('data', array(
            'Message' => 'Something very unexpected happened...',
            'Request' => $this->request 
        ));
    }
}