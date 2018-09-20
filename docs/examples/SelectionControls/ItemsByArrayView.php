<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SelectionControls;

use Rhubarb\Leaf\Controls\Common\SelectionControls\DropDown\DropDown;
use Rhubarb\Leaf\Views\View;

class ItemsByArrayView extends View
{
    protected function createSubLeaves()
    {
        $this->registerSubLeaf(
            $control = new DropDown("control")
        );

        $control->setSelectionItems(
            [
                ["", "Please Select"],
                [1, "Item 1"],
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
