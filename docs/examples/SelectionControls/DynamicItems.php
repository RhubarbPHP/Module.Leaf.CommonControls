<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SelectionControls;

use Rhubarb\Leaf\Leaves\Leaf;

class DynamicItems extends Leaf
{
    /** @var DynamicItemsModel $model **/
    protected $model;

    protected function getViewClass()
    {
        return DynamicItemsView::class;
    }

    protected function createModel()
    {
        return new DynamicItemsModel();
    }
}
