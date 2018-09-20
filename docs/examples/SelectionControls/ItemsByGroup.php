<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SelectionControls;

use Rhubarb\Leaf\Leaves\Leaf;

class ItemsByGroup extends Leaf
{
    /** @var ItemsByGroupModel $model **/
    protected $model;

    protected function getViewClass()
    {
        return ItemsByGroupView::class;
    }

    protected function createModel()
    {
        return new ItemsByGroupModel();
    }
}
