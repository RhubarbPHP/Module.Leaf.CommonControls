<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SelectionControls;

use Rhubarb\Leaf\Leaves\Leaf;

class RadioButtonsExample extends Leaf
{
    /** @var RadioButtonsExampleModel $model **/
    protected $model;

    protected function getViewClass()
    {
        return RadioButtonsExampleView::class;
    }

    protected function createModel()
    {
        return new RadioButtonsExampleModel();
    }
}
