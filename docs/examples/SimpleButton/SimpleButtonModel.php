<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SimpleButton;

use Rhubarb\Leaf\Leaves\LeafModel;

class SimpleButtonModel extends LeafModel
{
    public $simpleButtonText = '';

    /**
     * SimpleButtonModel constructor.
     */
    public function __construct()
    {
        $this->simpleButtonText = '';
    }
}
