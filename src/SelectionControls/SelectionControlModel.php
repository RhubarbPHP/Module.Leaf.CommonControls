<?php

namespace Rhubarb\Leaf\Controls\Common\SelectionControls;

use Rhubarb\Crown\Events\Event;
use Rhubarb\Leaf\Leaves\Controls\ControlModel;

class SelectionControlModel extends ControlModel
{
    /**
     * The array of items available for selection
     *
     * @var array
     */
    public $selectionItems = [];

    /**
     * The array of items selected
     *
     * @var array
     */
    public $selectedItems = [];

    /**
     * True if the control supports selecting multiple values
     *
     * @var bool
     */
    public $supportsMultipleSelection = false;

    /**
     * @var Event Raised when the selection control wants a refresh of available items.
     */
    public $updateAvailableSelectionItems;

    public function __construct()
    {
        parent::__construct();

        $this->updateAvailableSelectionItems = new Event();
    }

    /**
     * Return the list of properties that can be exposed publically
     *
     * @return array
     */
    protected function getExposableModelProperties()
    {
        $list = parent::getExposableModelProperties();
        $list[] = "selectedItems";

        return $list;
    }
}