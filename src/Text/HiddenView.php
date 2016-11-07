<?php

namespace Rhubarb\Leaf\Controls\Common\Text;

use Rhubarb\Leaf\Leaves\Controls\ControlView;
use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;

class HiddenView extends ControlView
{
    protected $htmlTypeAttribute = "hidden";

    protected function printViewContent()
    {
        ?>
        <input type="<?=$this->htmlTypeAttribute;?>" <?=$this->getNameValueClassAndAttributeString();?>/>
        <?php
    }
}
