<?php

namespace Rhubarb\Leaf\Controls\Common\Checkbox;

use Rhubarb\Leaf\Leaves\Controls\Control;

class Checkbox extends Control
{
    protected function getViewClass()
    {
        return CheckboxView::class;
    }

}