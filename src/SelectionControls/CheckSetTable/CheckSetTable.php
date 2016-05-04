<?php

namespace Rhubarb\Leaf\Controls\Common\SelectionControls\CheckSetTable;

use Rhubarb\Leaf\Controls\Common\SelectionControls\CheckSet\CheckSet;

/**
 * Horizontally oriented checkboxes
 */
class CheckSetTable extends CheckSet
{
    protected function createView()
    {
        return new CheckSetTableView();
    }
}
