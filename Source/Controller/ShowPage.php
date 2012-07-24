<?php
namespace JSomerstone\Cimbic\Controller;

class ShowPage extends \JSomerstone\Cimbic\Core\Controller
{
    public $pageID = null;

    protected function setup()
    {
        $this->view = new \JSomerstone\Cimbic\View\ShowPage();
        $this->view->set('request', $this->request);
    }

    public function _()
    {
        return $this->index();
    }

    public function index()
    {
        $this->pageID = $this->request->getGet('pageID') ?: 1;
        $this->view->bind('pageID', $this->pageID);
        $this->view->set('debug', 1);
    }
}