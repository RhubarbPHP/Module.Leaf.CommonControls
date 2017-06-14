<?php

namespace Rhubarb\Leaf\Controls\Common\DateTime;

class DateTime extends Date
{
    protected function getViewClass()
    {
        return DateTimeView::class;
    }
}
