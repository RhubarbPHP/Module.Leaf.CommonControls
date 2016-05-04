<?php

namespace Rhubarb\Leaf\Controls\Common\Buttons;

use Rhubarb\Crown\Events\Event;
use Rhubarb\Leaf\Leaves\Controls\ControlModel;
use Rhubarb\Leaf\Leaves\LeafModel;

class ButtonModel extends ControlModel
{
    public $text = "Submit";

    public $confirmMessage = "";

    /**
     * @var Event
     */
    public $buttonPressedEvent;

    public function __construct()
    {
        $this->buttonPressedEvent = new Event();

        parent::__construct();
    }
}