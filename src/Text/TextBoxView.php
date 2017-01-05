<?php

namespace Rhubarb\Leaf\Controls\Common\Text;

use Rhubarb\Leaf\Leaves\Controls\ControlView;
use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;

class TextBoxView extends ControlView
{
    /** @var  TextBoxModel */
    protected $model;

    protected $requiresStateInput = false;

    protected function printViewContent()
    {
        ?>
        <input type="<?= $this->model->inputType; ?>" <?= $this->getNameValueClassAndAttributeString(); ?>/>
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
