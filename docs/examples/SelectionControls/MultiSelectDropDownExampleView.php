<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SelectionControls;

use Rhubarb\Leaf\Controls\Common\SelectionControls\MultiSelect\MultiSelectDropDown;
use Rhubarb\Leaf\Views\View;

class MultiSelectDropDownExampleView extends View
{
    protected function createSubLeaves()
    {
        $this->registerSubLeaf(
            $control = new MultiSelectDropDown("control")
        );

        $control->setSelectionItems(
            [
                "Item 1",
                "Item 2",
                "Item 3"
            ]
        );
    }

    protected function printViewContent()
    {
        print $this->leaves["control"];
    }
}