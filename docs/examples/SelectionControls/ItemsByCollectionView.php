<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SelectionControls;

use Rhubarb\Leaf\Controls\Common\SelectionControls\DropDown\DropDown;
use Rhubarb\Leaf\Views\View;

class ItemsByCollectionView extends View
{
    protected function createSubLeaves()
    {
        $this->registerSubLeaf(
            $control = new DropDown("control")
        );

        $control->setSelectionItems(
            [
                ExampleContact::all()
                    ->addSort("FirstName")
                    ->addSort("Surname")
            ]
        );
    }

    protected function printViewContent()
    {
        print $this->leaves["control"];
    }
}
