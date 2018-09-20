<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SelectionControls;

use Rhubarb\Leaf\Leaves\Leaf;

class ItemsByString extends Leaf
{
    /** @var ItemsByStringModel $model **/
    protected $model;

    protected function getViewClass()
    {
        return ItemsByStringView::class;
    }

    protected function createModel()
    {
        return new ItemsByStringModel();
    }
}
