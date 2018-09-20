<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SelectionControls;

use Rhubarb\Leaf\Controls\Common\SelectionControls\RadioButtons\RadioButtons;
use Rhubarb\Leaf\Views\View;

class RadioButtonsExampleView extends View
{
    protected function createSubLeaves()
    {
        $this->registerSubLeaf(
            $control = new RadioButtons("control")
        );

        $control->setSelectionItems(
            [
                "Item 1",
                "Item 2",
                [ 3, "Item 3"],
                ExampleContact::all()->addSort("FirstName")
            ]
        );
    }

    protected function printViewContent()
    {
        print $this->leaves["control"];
    }
}