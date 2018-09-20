<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SelectionControls;

use Rhubarb\Leaf\Leaves\Leaf;

class ItemsByArray extends Leaf
{
    /** @var ItemsByArrayModel $model **/
    protected $model;

    protected function getViewClass()
    {
        return ItemsByArrayView::class;
    }

    protected function createModel()
    {
        return new ItemsByArrayModel();
    }
}
