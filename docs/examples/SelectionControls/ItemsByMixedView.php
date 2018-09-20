<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SelectionControls;

use Rhubarb\Leaf\Controls\Common\SelectionControls\DropDown\DropDown;
use Rhubarb\Leaf\Views\View;
use Rhubarb\Stem\Filters\StartsWith;

class ItemsByMixedView extends View
{
    protected function createSubLeaves()
    {
        $this->registerSubLeaf(
            $control = new DropDown("control")
        );

        $control->setSelectionItems(
            [
                [ "", "Please Select"],
                "Item 1",
                "Item 2",
                [ 3, "Item 3"],
                ExampleContact::all()->addSort("FirstName"),
                ExampleContact::all()->addSort("FirstName", false),
                (new ExampleContact())->getModelColumnSchemaForColumnReference("Status"),
                "Group 1" => [
                    ExampleContact::find(new StartsWith("FirstName", "J"))
                ]
            ]
        );
    }

    protected function printViewContent()
    {
        print $this->leaves["control"];
    }
}