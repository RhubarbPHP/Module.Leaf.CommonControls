<?php

namespace Rhubarb\Leaf\Controls\Common\Buttons;

use Rhubarb\Crown\Events\Event;
use Rhubarb\Leaf\Leaves\Leaf;

/**
 * The Button leaf is used to raise action events.
 *
 * Note, it's not strictly a control as it doesn't support binding for example but most people still
 * consider a button as an interface control.
 */
class Button extends Leaf
{
    /**
     * Raised when the button is pressed.
     *
     * @var Event
     */
    public $buttonPressedEvent;

    /**
     * @var ButtonModel
     */
    protected $model;

    protected function getViewClass()
    {
        return ButtonView::class;
    }
    
    protected function createModel()
    {
        $model = new ButtonModel();
        $model->buttonPressedEvent->attachHandler(function(...$arguments){
            $this->buttonPressedEvent->raise(...$arguments);
        });

        return $model;
    }
}