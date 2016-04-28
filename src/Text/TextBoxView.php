<?php

namespace Rhubarb\Leaf\Controls\Common\Text;

use Rhubarb\Leaf\Leaves\Controls\ControlView;

class TextBoxView extends ControlView
{
    protected $requiresStateInput = false;

    protected function printViewContent()
    {
        $classes = $this->model->getClassAttribute();
        $otherAttributes = $this->model->getHtmlAttributes();

        ?>
        <input type="text" name="<?=$this->model->leafPath;?>" value="<?=htmlentities($this->model->value);?>"<?=$classes.$otherAttributes;?> />
        <?php
    }
}