<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SelectionControls;

use Rhubarb\Leaf\Leaves\Leaf;

class SearchControlExample extends Leaf
{
    /** @var SearchControlExampleModel $model **/
    protected $model;

    protected function getViewClass()
    {
        return SearchControlExampleView::class;
    }

    protected function createModel()
    {
        return new SearchControlExampleModel();
    }
}
