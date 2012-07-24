<?php

namespace JSomerstone\Cimbic\Controller;

class Index extends \JSomerstone\Cimbic\Core\Controller
{
    public function index()
    {
        $this->setView(new \JSomerstone\Cimbic\View\EmptyView());
        $controller = sprintf(
                '\\JSomerstone\Cimbic\\Controller\\%s',
                $this->request->getController() ?: 'ShowPage'
        );
        if (class_exists($controller))
        {
            $subController = new $controller($this->request);
            $subController->run();
        }
    }

}
