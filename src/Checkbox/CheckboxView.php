<?php

namespace Rhubarb\Leaf\Controls\Common\Checkbox;

use Rhubarb\Crown\Deployment\DeploymentPackage;
use Rhubarb\Crown\Request\WebRequest;
use Rhubarb\Leaf\Leaves\Controls\ControlView;
use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;

class CheckboxView extends ControlView
{
    protected $requiresStateInput = false;

    protected function printViewContent()
    {
        $attributes = $this->getNameValueClassAndAttributeString(false);
        $attributes .= $this->model->value ? ' checked="checked"' : '';

        // include a hidden presence input, because on submit if the checkbox is unchecked it won't be included in the
        // POST data. The presence input can be used to detect that the input has been submitted and should be FALSE.
        $presence = $this->getPresenceInputName();
        print "<input type='checkbox' {$attributes}/><input type='hidden' name='{$presence}' value='0'>";
    }

    /**
     * @return string
     */
    private function getPresenceInputName()
    {
        return 'set_' . $this->model->leafPath;
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
        return new LeafDeploymentPackage(__DIR__ . "/CheckboxViewBridge.js");
    }

    protected function parseRequest(WebRequest $request)
    {
        $path = $this->model->leafPath;

        // By default if a control can be represented by a single HTML element then the name of that element
        // should equal the leaf path of the control. If that is true then we can automatically discover and
        // update our model.

        $value = $request->post($path);
        if (isset($value)) {
            $this->model->setValue((bool) $value);
        } else {
            $presence = $request->post($this->getPresenceInputName());
            if (isset($presence)) {
                $this->model->setValue(false);
            }
        }

        // By default if a control can be represented by a single HTML element then the name of that element
        // should equal the leaf path of the control. If that is true then we can automatically discover and
        // update our model.

        $postData = $request->postData;
        $checked = [];
        foreach ($postData as $key => $value) {
            if (preg_match("/^" . $path . "\((.+?)\)$/", $key, $match)) {
                $checked[] = $match[1];
                $this->setControlValueForIndex($match[1], true);
            } else {
                if (preg_match("/^" . $this->getPresenceInputName() . "\((.+?)\)$/", $key, $match) && !in_array($match[1], $checked)) {
                    $this->setControlValueForIndex($match[1], false);
                }
            }
        }
    }
}
