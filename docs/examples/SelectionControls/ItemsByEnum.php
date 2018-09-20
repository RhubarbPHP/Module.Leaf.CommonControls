<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SelectionControls;

use Rhubarb\Leaf\Leaves\Leaf;

class ItemsByEnum extends Leaf
{
    /** @var ItemsByEnumModel $model **/
    protected $model;

    protected function getViewClass()
    {
        return ItemsByEnumView::class;
    }

    protected function createModel()
    {
        return new ItemsByEnumModel();
    }
}
