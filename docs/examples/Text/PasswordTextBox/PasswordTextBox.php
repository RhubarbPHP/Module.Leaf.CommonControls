<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\Text\PasswordTextBox;

use Rhubarb\Leaf\Leaves\Leaf;

class PasswordTextBox extends Leaf
{
    /**
    * @var PasswordTextBoxModel
    */
    protected $model;
    
    protected function getViewClass()
    {
        return PasswordTextBoxView::class;
    }
    
    protected function createModel()
    {
        return new PasswordTextBoxModel();
    }
}