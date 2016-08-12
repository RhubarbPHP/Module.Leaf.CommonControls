<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SimpleButton;

use Rhubarb\Leaf\Controls\Common\Buttons\Button;
use Rhubarb\Leaf\Views\View;

class SimpleButtonView extends View
{
    /** @var SimpleButtonModel $model */
    protected $model;

    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            $simpleButton = new Button("SimpleButton", "Click Me", function () {
                $this->model->simpleButtonText = 'You just clicked the Simple Button.';
            })
        );
    }

    protected function printViewContent()
    {
        parent::printViewContent();

        if ($this->model->simpleButtonText) {
            print $this->model->simpleButtonText;
        } else {
            print 'Click the button below to see what happens?';
        }

        print $this->leaves["SimpleButton"];
    }
}
