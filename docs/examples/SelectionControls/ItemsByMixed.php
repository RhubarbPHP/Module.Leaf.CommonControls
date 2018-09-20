<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SelectionControls;

use Rhubarb\Leaf\Leaves\Leaf;

class ItemsByMixed extends Leaf
{
    /** @var ItemsByMixedModel $model **/
    protected $model;

    protected function getViewClass()
    {
        return ItemsByMixedView::class;
    }

    protected function createModel()
    {
        return new ItemsByMixedModel();
    }
}
