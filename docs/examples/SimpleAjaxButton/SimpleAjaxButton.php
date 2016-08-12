<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SimpleAjaxButton;

use Rhubarb\Leaf\Leaves\Leaf;
use Rhubarb\Leaf\Leaves\LeafModel;

class SimpleAjaxButton extends Leaf
{

    /**
     * Returns the name of the standard view used for this leaf.
     *
     * @return string
     */
    protected function getViewClass()
    {
        return SimpleAjaxButtonView::class;
    }

    /**
     * Should return a class that derives from LeafModel
     *
     * @return LeafModel
     */
    protected function createModel()
    {
        return new SimpleAjaxButtonModel();
    }
}
