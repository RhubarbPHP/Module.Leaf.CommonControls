<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SelectionControls;

use Rhubarb\Leaf\Leaves\Leaf;

class MultiSelectDropDownExample extends Leaf
{
    /** @var MultiSelectDropDownExampleModel $model **/
    protected $model;

    protected function getViewClass()
    {
        return MultiSelectDropDownExampleView::class;
    }

    protected function createModel()
    {
        return new MultiSelectDropDownExampleModel();
    }
}
