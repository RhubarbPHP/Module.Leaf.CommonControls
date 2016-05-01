<?php

namespace Rhubarb\Leaf\Controls\Common\Text;

class PasswordTextBox extends TextBox
{
    protected function getViewClass()
    {
        return PasswordTextBoxView::class;
    }
}