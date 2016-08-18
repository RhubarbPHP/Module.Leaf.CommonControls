<?php

namespace Rhubarb\Leaf\Controls\Common\Checkbox;

use Rhubarb\Crown\Deployment\DeploymentPackage;
use Rhubarb\Crown\Request\WebRequest;
use Rhubarb\Leaf\Leaves\Controls\ControlView;
use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;

class CheckboxView extends ControlView
{
    protected function printViewContent()
    {
        $checked = ($this->model->value) ? ' checked="checked"' : '';
        ?><input type="checkbox" <?=$this->getNameValueClassAndAttributeString(false).$checked;?>/><?php
    }

    /**
     * If the leaf requires a view bridge this returns it's name.
     *
     * @return string|bool
     */
    protected function getViewBridgeName()
    {
        return "CheckboxViewBridge";
    }

    /**
     * @return DeploymentPackage
     */
    public function getDeploymentPackage()
    {
        return new LeafDeploymentPackage(__DIR__."/CheckboxViewBridge.js");
    }

    protected function parseRequest(WebRequest $request)
    {
        $path = $this->model->leafPath;

        // By default if a control can be represented by a single HTML element then the name of that element
        // should equal the leaf path of the control. If that is true then we can automatically discover and
        // update our model.

        $value = $request->post($path);
        if ($value !== null){
            $this->model->setValue($value);
        }

        // By default if a control can be represented by a single HTML element then the name of that element
        // should equal the leaf path of the control. If that is true then we can automatically discover and
        // update our model.

        $postData = $request->postData;

        foreach($postData as $key => $value){
            if (preg_match("/".$this->model->leafPath."\(([^)]+)\)$/", $key, $match)){
                $this->setControlValueForIndex($match[1], true);
            }
        }
    }
}
