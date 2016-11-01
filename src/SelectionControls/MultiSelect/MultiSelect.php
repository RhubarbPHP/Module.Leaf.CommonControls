<?php

namespace Rhubarb\Leaf\Controls\Common\SelectionControls\MultiSelect;

use Rhubarb\Leaf\Controls\Common\SelectionControls\SelectionControl;

class MultiSelect extends SelectionControl
{
    protected function getViewClass()
    {
        return MultiSelectView::class;
    }

    protected function supportsMultipleSelection()
    {
        return true;
    }
}