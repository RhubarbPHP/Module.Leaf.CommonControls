<?php

namespace Rhubarb\Leaf\Controls\Common\Buttons;

use Rhubarb\Crown\Events\Event;
use Rhubarb\Leaf\Leaves\Controls\Control;
use Rhubarb\Leaf\Leaves\Leaf;
use Symfony\Component\EventDispatcher\Tests\CallableClass;

/**
 * The Button leaf is used to raise action events.
 *
 * Note, it's not strictly a control as it doesn't support binding for example but most people still
 * consider a button as an interface control.
 */
class Button extends Control
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

    public function __construct($name, $text = "", callable $pressedCallback = null)
    {
        parent::__construct($name);

        $this->model->text = $text;
        $this->buttonPressedEvent = new Event();

        if ($pressedCallback){
            $this->model->buttonPressedEvent->attachHandler(function() use ($pressedCallback){
                $this->runBeforeRender($pressedCallback);
            });
        }
    }

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