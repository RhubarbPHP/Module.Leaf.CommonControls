<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\Text\PasswordTextBox;

use Rhubarb\Leaf\Views\View;
use Rhubarb\Leaf\Controls\Common\Text\PasswordTextBox;

class PasswordTextBoxView extends View
{
    /**
    * @var PasswordTextBoxModel
    */
    protected $model;

    protected function createSubLeaves()
    {
        $this->registerSubLeaf(
            $password = new PasswordTextBox("password")
        );

        $password->setMaxLength(15);
    }

    protected function printViewContent()
    {
        print $this->leaves["password"];
    }
}