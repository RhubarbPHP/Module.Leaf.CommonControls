<?php

namespace Rhubarb\Leaf\Controls\Common\Text;

use Rhubarb\Leaf\Leaves\Controls\ControlView;
use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;

class TextBoxView extends ControlView
{
    protected $requiresStateInput = false;
    protected $htmlTypeAttribute = "text";

    protected function printViewContent()
    {
        ?>
        <input type="<?=$this->htmlTypeAttribute;?>" <?=$this->getNameValueClassAndAttributeString();?>/>
        <?php
    }

    public function getDeploymentPackage()
    {
        return new LeafDeploymentPackage(__DIR__."/TextBoxViewBridge.js");
    }

    protected function getViewBridgeName()
    {
        return "TextBoxViewBridge";
    }
}