<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\Text\TextArea;

use Rhubarb\Leaf\Controls\Common\Text\TextArea;
use Rhubarb\Leaf\Views\View;

class TextAreaView extends View
{
    /**
    * @var TextAreaModel
    */
    protected $model;

    protected function createSubLeaves()
    {
        $this->registerSubLeaf(
            $description = new TextArea("description")
        );

        $description->setPlaceholderText("Enter a description");
    }

    protected function printViewContent()
    {
        print $this->leaves["description"];
    }
}