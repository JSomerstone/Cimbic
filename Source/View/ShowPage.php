<?php
namespace JSomerstone\Cimbic\View;

class ShowPage extends \JSomerstone\Cimbic\Core\View
{
    public $pageID = null;
    public $request;
    public $debug;

    public function __toString()
    {
        $output = array('<h1>',
            "Showing page #$this->pageID", '</h1>'
        );

        if ($this->debug)
            $output[] = $this->_printDebug ();

        return implode('', $output);
    }

    private function _printDebug()
    {
        return sprintf('<div id="debugContainer">%s<hr>%s</div>',
            nl2br(var_export($this->request->getGet(), true)),
            nl2br(var_export($this->request->getPost(), true))
        );
    }
}