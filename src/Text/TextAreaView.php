<?php

namespace Rhubarb\Leaf\Controls\Common\Text;

class TextAreaView extends TextBoxView
{
    protected function printViewContent()
    {
        print '<textarea '.$this->getNameValueClassAndAttributeString(false).'>'.htmlentities($this->model->value).'</textarea>';
    }

}