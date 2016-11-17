<?php

namespace Rhubarb\Leaf\Controls\Common\Text;

use Rhubarb\Leaf\Leaves\Controls\Control;

class TextBox extends Control
{
    /** @var  TextBoxModel */
    protected $model;
    
    protected function getViewClass()
    {
        return TextBoxView::class;
    }

    protected function createModel()
    {
        return new TextBoxModel();
    }

    public function setMaxLength($maxLength)
    {
        $this->addHtmlAttribute("maxlength", $maxLength);
    }
    
    public function setInputType($inputType)
    {
        $this->model->inputType = $inputType;
    }
}
