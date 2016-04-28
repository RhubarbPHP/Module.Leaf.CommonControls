<?php

namespace Rhubarb\Leaf\Controls\Common\Buttons;

use Rhubarb\Crown\Events\Event;
use Rhubarb\Leaf\Leaves\LeafModel;

class ButtonModel extends LeafModel
{
    public $text = "Submit";

    /**
     * @var Event
     */
    public $buttonPressedEvent;

    public function __construct()
    {
        $this->buttonPressedEvent = new Event();
    }
}