<?php

namespace Rhubarb\Leaf\Controls\Common\Text;

use Rhubarb\Leaf\Leaves\Controls\ControlView;

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
}