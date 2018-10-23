<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SelectionControls;

use Rhubarb\Leaf\Controls\Common\SelectionControls\DropDown\DropDown;

class MenuDropDown extends DropDown
{
    public function __construct(string $name = null)
    {
        parent::__construct($name);

        $this->setSelectionItems([
            ["", "Please select a cuisine first"]
        ]);
    }

    protected function updateAvailableSelectionItems($cuisine, ...$additionalParams)
    {
        switch ($cuisine){
            case "French":
                $this->setSelectionItems([
                    ["", "Please Select"],
                    ["Steak"]
                ]);
                break;
            case "Italian":
                $this->setSelectionItems([
                    ["", "Please Select"],
                    ["Lasagna"],
                    ["Carbonara"]
                ]);
                break;
            default:
                $this->setSelectionItems([
                    ["", "Please Select"],
                    ["Fish"],
                    ["Chips"]
                ]);
                break;
        }
    }
}