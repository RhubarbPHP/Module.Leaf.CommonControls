<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\Text\TextBox;

use Rhubarb\Leaf\Leaves\Leaf;

class TextBox extends Leaf
{
    /**
    * @var TextBoxModel
    */
    protected $model;
    
    protected function getViewClass()
    {
        return TextBoxView::class;
    }
    
    protected function createModel()
    {
        return new TextBoxModel();
    }
}