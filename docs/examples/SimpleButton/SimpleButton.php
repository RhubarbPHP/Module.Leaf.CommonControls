<?php

namespace Rhubarb\Leaf\Controls\Common\Examples;

use Rhubarb\Leaf\Leaves\Leaf;
use Rhubarb\Leaf\Leaves\LeafModel;

class SimpleButton extends Leaf
{

    /**
     * Returns the name of the standard view used for this leaf.
     *
     * @return string
     */
    protected function getViewClass()
    {
        return SimpleButtonView::class;
    }

    /**
     * Should return a class that derives from LeafModel
     *
     * @return LeafModel
     */
    protected function createModel()
    {
        return new SimpleButtonModel();
    }
}