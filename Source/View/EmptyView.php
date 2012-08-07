<?php

namespace JSomerstone\Cimbic\View;

class EmptyView extends CoreView
{
    public function __toString()
    {

        return '';
    }
}