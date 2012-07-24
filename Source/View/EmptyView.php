<?php

namespace JSomerstone\Cimbic\View;

class EmptyView extends \JSomerstone\Cimbic\Core\View
{
    public function __toString()
    {

        return '';
    }
}