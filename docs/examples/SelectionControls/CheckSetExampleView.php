<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SelectionControls;

use Rhubarb\Leaf\Controls\Common\SelectionControls\CheckSet\CheckSet;
use Rhubarb\Leaf\Controls\Common\SelectionControls\CheckSetTable\CheckSetTable;
use Rhubarb\Leaf\Views\View;

class CheckSetExampleView extends View
{
    protected function createSubLeaves()
    {
        $this->registerSubLeaf(
            $control = new CheckSet("control"),
            $table = new CheckSetTable("table")
        );

        $control->setSelectionItems(
            [
                "Item 1",
                "Item 2",
                [ 3, "Item 3"],
                ExampleContact::all()->addSort("FirstName")
            ]
        );

        $table->setSelectionItems(
            [
                "Item 1",
                "Item 2",
                [ 3, "Item 3"]
            ]
        );
    }

    protected function printViewContent()
    {
        print "<h3>Normal CheckSet</h3>";
        print $this->leaves["control"];
        print "<h3>CheckSetTable</h3>";
        print $this->leaves["table"];
    }
}