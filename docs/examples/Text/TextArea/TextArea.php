<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\Text\TextArea;

use Rhubarb\Leaf\Leaves\Leaf;

class TextArea extends Leaf
{
    /**
    * @var TextAreaModel
    */
    protected $model;
    
    protected function getViewClass()
    {
        return TextAreaView::class;
    }
    
    protected function createModel()
    {
        return new TextAreaModel();
    }
}