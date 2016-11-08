<?php

namespace Rhubarb\Leaf\Controls\Common\Text;

use Rhubarb\Leaf\Leaves\Controls\ControlView;
use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;

class HiddenView extends ControlView
{
    protected function printViewContent()
    {
        ?>
        <input type="hidden" <?= $this->getNameValueClassAndAttributeString(); ?>/>
        <?php
    }

    public function getDeploymentPackage()
    {
        return new LeafDeploymentPackage(__DIR__ . '/HiddenViewBridge.js');
    }

    protected function getViewBridgeName()
    {
        return "HiddenViewBridge";
    }
}
