<?php

namespace Rhubarb\Leaf\Controls\Common\Text;

class TextArea extends TextBox
{
    protected function getViewClass()
    {
        return TextAreaView::class;
    }

}