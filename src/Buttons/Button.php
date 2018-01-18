<?php

namespace Rhubarb\Leaf\Controls\Common\Buttons;

use Rhubarb\Crown\Events\Event;
use Rhubarb\Leaf\Leaves\Controls\Control;

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

    public function __construct($name, $text = "", callable $pressedCallback = null, $useXhr = false)
    {
        parent::__construct($name);

        $this->model->text = $text;
        $this->model->useXhr = $useXhr;
        $this->buttonPressedEvent = new Event();

        if ($pressedCallback) {
            $this->buttonPressedEvent->attachHandler($pressedCallback);
        }
    }

    public function setConfirmMessage($confirmMessage)
    {
        $this->model->confirmMessage = $confirmMessage;
    }

    protected function getViewClass()
    {
        return ButtonView::class;
    }

    public function setButtonText($buttonText)
    {
        $this->model->text = $buttonText;
    }

    public function setUseXhr($useXhr)
    {
        $this->model->useXhr = $useXhr;
    }

    protected function createModel()
    {
        $model = new ButtonModel();
        $model->buttonPressedEvent->attachHandler(function (...$arguments) {
            if ($this->model->useXhr) {
                if ($this->model->leafIndex){
                    array_splice($arguments, 0, 0, [$this->model->leafIndex]);
                }

                return $this->buttonPressedEvent->raise(...$arguments);
            } else {
                $this->runBeforeRender(function () use ($arguments) {
                    $this->buttonPressedEvent->raise(...$arguments);
                });
            }
        });

        return $model;
    }

    /**
     * Allows changing the HTML input type from default "submit"
     *
     * @param string $type e.g. "submit", "button", "reset"
     * @param bool $submitFormOnClick If true, javascript will
     */
    public function setButtonType($type, $submitFormOnClick = false)
    {
        $this->model->type = $type;

        if ($submitFormOnClick) {
            $this->model->addCssClassNames("submit-on-click");
        }
    }
}
