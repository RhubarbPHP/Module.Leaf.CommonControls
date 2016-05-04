<?php

namespace Rhubarb\Leaf\Controls\Common\Buttons;

use Rhubarb\Crown\Deployment\DeploymentPackage;
use Rhubarb\Crown\Request\WebRequest;
use Rhubarb\Leaf\Leaves\Controls\ControlView;
use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;

class ButtonView extends ControlView
{
    /**
     * @var ButtonModel
     */
    protected $model;

    protected function printViewContent()
    {
        $classes = $this->model->getClassAttribute();
        $otherAttributes = $this->model->getHtmlAttributes();

        $confirmAttribute = ($this->model->confirmMessage != "") ? ' data-confirm-message="'.htmlentities($this->model->confirmMessage).'"' : '';

        ?>
        <input type="submit" name="<?=$this->model->leafPath;?>" value="<?=htmlentities($this->model->text);?>"<?=$classes.$otherAttributes.$confirmAttribute;?> />
        <?php
    }

    protected function parseRequest(WebRequest $request)
    {
        $value = $request->post($this->model->leafPath);

        if ($value != null){
            $this->model->buttonPressedEvent->raise();
        }
    }

    /**
     * If the leaf requires a view bridge this returns it's name.
     *
     * @return string|bool
     */
    protected function getViewBridgeName()
    {
        return "ButtonViewBridge";
    }

    /**
     * @return DeploymentPackage
     */
    public function getDeploymentPackage()
    {
        return new LeafDeploymentPackage(__DIR__."/ButtonViewBridge.js");
    }
}