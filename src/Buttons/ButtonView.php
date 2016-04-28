<?php

namespace Rhubarb\Leaf\Controls\Common\Buttons;

use Rhubarb\Crown\Request\WebRequest;
use Rhubarb\Leaf\Leaves\Controls\ControlView;
use Rhubarb\Leaf\Views\View;

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

        ?>
        <input type="submit" name="<?=$this->model->leafPath;?>" value="<?=htmlentities($this->model->text);?>"<?=$classes.$otherAttributes;?> />
        <?php
    }

    protected function parseRequest(WebRequest $request)
    {
        $value = $request->post($this->model->leafPath);

        if ($value != null){
            $this->model->buttonPressedEvent->raise();
        }
    }
}