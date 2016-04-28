<?php

namespace Rhubarb\Leaf\Controls\Common\Buttons;

use Rhubarb\Leaf\Views\View;

class ButtonView extends View
{

    /**
     * @var ButtonModel
     */
    protected $model;

    protected function printViewContent()
    {
        ?>
        <input type="submit" name="<?=$this->model->leafPath;?>" value="<?=htmlentities($this->model->text);?>" />
        <?php
    }
}