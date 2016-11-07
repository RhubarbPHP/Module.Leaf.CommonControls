<?php

namespace Rhubarb\Leaf\Controls\Common\Text;

use Rhubarb\Leaf\Leaves\Controls\Control;

class Hidden extends Control
{
    protected function getViewClass()
    {
        return HiddenView::class;
    }
}
