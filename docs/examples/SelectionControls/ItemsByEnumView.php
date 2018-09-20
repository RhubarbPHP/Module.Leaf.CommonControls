<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SelectionControls;

use Rhubarb\Leaf\Controls\Common\SelectionControls\DropDown\DropDown;
use Rhubarb\Leaf\Views\View;

class ItemsByEnumView extends View
{
    protected function createSubLeaves()
    {
        $this->registerSubLeaf(
            $control = new DropDown("control")
        );

        $control->setSelectionItems(
            [
                (new ExampleContact())->getModelColumnSchemaForColumnReference("Status")
            ]
        );
    }

    protected function printViewContent()
    {
        print $this->leaves["control"];
    }
}
