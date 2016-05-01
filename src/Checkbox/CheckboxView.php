<?php

namespace Rhubarb\Leaf\Controls\Common\Checkbox;

use Rhubarb\Leaf\Leaves\Controls\ControlView;

class CheckboxView extends ControlView
{
    protected function printViewContent()
    {
        $checked = ($this->model->value) ? ' checked="checked"' : '';
        ?><input type="checkbox" <?=$this->getNameValueClassAndAttributeString(false).$checked;?>/><?php
    }
}