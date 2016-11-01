<?php

namespace Rhubarb\Leaf\Controls\Common\SelectionControls\MultiSelect;

use Rhubarb\Leaf\Controls\Common\SelectionControls\DropDown\DropDown;

class MultiSelect extends DropDown
{
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