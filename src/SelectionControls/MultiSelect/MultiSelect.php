<?php

namespace Rhubarb\Leaf\Controls\Common\SelectionControls\MultiSelect;

use Rhubarb\Leaf\Controls\Common\SelectionControls\DropDown\DropDownView;
use Rhubarb\Leaf\Controls\Common\SelectionControls\SelectionControl;

class MultiSelect extends SelectionControl
{
    protected function getViewClass()
    {
        return DropDownView::class;
    }

    protected function supportsMultipleSelection()
    {
        return true;
    }

    protected function onModelCreated()
    {
        parent::onModelCreated();

        $this->model->addHtmlAttribute("multiple", "multiple");
    }


}