<?php

namespace Rhubarb\Leaf\Controls\Common\Text;

use Rhubarb\Leaf\Leaves\Controls\Control;

class TextBox extends Control
{
    protected function getViewClass()
    {
        return TextBoxView::class;
    }
}