<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SelectionControls;

use Rhubarb\Leaf\Controls\Common\SelectionControls\DropDown\DropDown;
use Rhubarb\Leaf\Views\View;

class ItemsByGroupView extends View
{
    protected function createSubLeaves()
    {
        $this->registerSubLeaf(
            $control = new DropDown("control")
        );

        $control->setSelectionItems(
            [
                "Group 1" => [
                    "Item 1",
                    "Item 2",
                ],
                "Group 2" => [
                    [3, "Item 3"]
                ]
            ]
        );
    }

    protected function printViewContent()
    {
        print $this->leaves["control"];
    }
}