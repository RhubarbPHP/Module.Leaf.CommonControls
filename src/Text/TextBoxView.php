<?php

namespace Rhubarb\Leaf\Controls\Common\Text;

use Rhubarb\Leaf\Leaves\Controls\ControlView;

class TextBoxView extends ControlView
{
    protected $requiresStateInput = false;

    protected function printViewContent()
    {
        ?>
        <input type="text" name="<?=$this->model->leafPath;?>" value="<?=htmlentities($this->model->value);?>" />
        <?php
    }
}