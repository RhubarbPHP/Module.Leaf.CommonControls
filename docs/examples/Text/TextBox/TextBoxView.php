<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\Text\TextBox;

use Rhubarb\Leaf\Controls\Common\Text\TextBox;
use Rhubarb\Leaf\Views\View;

class TextBoxView extends View
{
    /**
    * @var TextBoxModel
    */
    protected $model;

    protected function createSubLeaves()
    {
        $this->registerSubLeaf(
            $forename = new TextBox("forename"),
            $surname = new TextBox("surname"),
            $houseNumber = new TextBox("houseNumber")
        );

        $forename->setPlaceholderText("Forename");
        $surname->setPlaceholderText("Surname");
        $houseNumber->setMaxLength(5);
        $houseNumber->setPlaceholderText("House No. (limited to 5 characters)");
    }

    protected function printViewContent()
    {
        print $this->leaves["forename"]." ".$this->leaves["surname"]." ".$this->leaves["houseNumber"];
    }
}