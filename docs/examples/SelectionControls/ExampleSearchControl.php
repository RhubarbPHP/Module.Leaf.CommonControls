<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SelectionControls;

use Rhubarb\Crown\String\StringTools;
use Rhubarb\Leaf\Controls\Common\SelectionControls\SearchControl\SearchControl;

class ExampleSearchControl extends SearchControl
{
    protected function getResultColumns()
    {
        return ["FirstName", "Surname"];
    }

    protected function getCurrentlyAvailableSelectionItems()
    {
        $items = parent::getCurrentlyAvailableSelectionItems();

        $filteredItems = [];

        foreach($items as $item) {
            if (StringTools::contains($item->label, $this->model->searchPhrase, false)) {
                $filteredItems[] = $item;
            }
        }

        return $filteredItems;
    }
}