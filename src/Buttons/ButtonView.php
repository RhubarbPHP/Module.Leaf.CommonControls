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

        $confirmAttribute = ($this->model->confirmMessage != "") ? ' confirm="'.htmlentities($this->model->confirmMessage).'"' : '';
        $xhrAttribute = ($this->model->useXhr) ? ' xmlrpc="yes"' : '';

        ?>
        <input leaf-name="<?=$this->model->leafName;?>" type="submit" name="<?=$this->model->leafPath;?>" id="<?=$this->model->leafPath;?>" value="<?=htmlentities($this->model->text);?>"<?=$classes.$otherAttributes.$confirmAttribute.$xhrAttribute;?> />
        <?php
    }

    protected function parseRequest(WebRequest $request)
    {
        $postData = $request->postData;

        foreach($postData as $key => $value){
            if (preg_match("/".$this->model->leafPath."\(([^)]+)\)$/", $key, $match)){
                if ($value != null){
                    $this->model->buttonPressedEvent->raise($match[1]);
                }
            }
        }

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