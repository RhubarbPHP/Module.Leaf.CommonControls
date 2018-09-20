<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SelectionControls;

use Rhubarb\Leaf\Leaves\Leaf;

class CheckSetExample extends Leaf
{
    /** @var CheckSetExampleModel $model **/
    protected $model;

    protected function getViewClass()
    {
        return CheckSetExampleView::class;
    }

    protected function createModel()
    {
        return new CheckSetExampleModel();
    }
}
