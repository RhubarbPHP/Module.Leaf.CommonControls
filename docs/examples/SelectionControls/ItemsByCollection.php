<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SelectionControls;

use Rhubarb\Leaf\Leaves\Leaf;

class ItemsByCollection extends Leaf
{
    /** @var ItemsByCollectionModel $model **/
    protected $model;

    protected function getViewClass()
    {
        return ItemsByCollectionView::class;
    }

    protected function createModel()
    {
        return new ItemsByCollectionModel();
    }
}
