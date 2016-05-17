<?php

namespace Rhubarb\Leaf\Controls\Common\Checkbox;

use Rhubarb\Crown\Request\WebRequest;
use Rhubarb\Leaf\Leaves\Controls\ControlView;

class CheckboxView extends ControlView
{
    protected function printViewContent()
    {
        $checked = ($this->model->value) ? ' checked="checked"' : '';
        ?><input type="checkbox" <?=$this->getNameValueClassAndAttributeString(false).$checked;?>/><?php
    }

    protected function parseRequest(WebRequest $request)
    {
        $path = $this->model->leafPath;

        // By default if a control can be represented by a single HTML element then the name of that element
        // should equal the leaf path of the control. If that is true then we can automatically discover and
        // update our model.

        if ($request->server('REQUEST_METHOD')=="POST") {
            $value = $request->post($path);
            if ($value !== null) {
                $this->model->setValue(true);
            } else {
                $this->model->setValue(false);
            }
        }
    }
}
