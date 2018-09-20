<?php

/*
 *	Copyright 2015 RhubarbPHP
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */

namespace Rhubarb\Leaf\Controls\Common\SelectionControls;

use Rhubarb\Crown\Context;
use Rhubarb\Leaf\Leaves\Controls\Control;
use Rhubarb\Leaf\Presenters\Controls\ControlPresenter;
use Rhubarb\Stem\Collections\Collection;
use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\Schema\Columns\MySqlEnumColumn;

/**
 * A base class for all controls implementing a range of options to pick from.
 *
 * Provides support for manual items, items from an enum column type, from a model collection
 * and callbacks.
 */
class SelectionControl extends Control
{
    /**
     * @var SelectionControlModel
     */
    protected $model;

    /**
     * The configured selection items
     *
     * @var array
     */
    protected $selectionItems = [];


    protected function createModel()
    {
        return new SelectionControlModel();
    }

    protected function onModelCreated()
    {
        parent::onModelCreated();

        $this->model->supportsMultipleSelection = $this->supportsMultipleSelection();
        $this->model->updateAvailableSelectionItemsEvent->attachHandler(function (...$args) {
            $this->updateAvailableSelectionItems(...$args);

            return $this->getCurrentlyAvailableSelectionItems();
        });
    }

    /**
     * Returns the list of configured selection items
     *
     * @return array
     */
    public function getSelectionItems()
    {
        return $this->selectionItems;
    }

    private function arrayToItems($array)
    {
        $items = [];

        foreach ($array as $key => $item) {

            if (is_string($key)){
                $nestedItems = $this->arrayToItems($item);

                $item = $this->makeItem("", $key);
                $item->Children = $nestedItems;

                $items[] = $item;
            } else {

                if ($item instanceof Collection) {
                    foreach ($item as $key => $model) {
                        $items[] = $this->makeItem($this->getValueForItem($key), $model->getLabel(), $this->getDataForItem($model));
                    }
                } elseif ($item instanceof MySqlEnumColumn) {
                    $enumValues = $item->enumValues;

                    foreach ($enumValues as $enumValue) {
                        $items[] = $this->makeItem($enumValue, $enumValue);
                    }
                } elseif (is_array($item)) {
                    if (count($item) > 0) {
                        if (is_array($item[0])) {
                            foreach ($item as $subItem) {
                                $value = $subItem[0];
                                $label = (sizeof($subItem) == 1) ? $subItem[0] : $subItem[1];

                                $data = (sizeof($subItem) > 2) ? $subItem[2] : [];

                                $items[] = $this->makeItem($value, $label, $data);
                            }
                        } else {
                            $value = $item[0];
                            $label = (sizeof($item) == 1) ? $item[0] : $item[1];

                            $data = (sizeof($item) > 2) ? $item[2] : [];

                            $items[] = $this->makeItem($value, $label, $data);
                        }
                    }
                } else {
                    $items[] = $this->makeItem($item, $item);
                }
            }
        }

        return $items;
    }

    /**
     * Inflates the configured selection items into their real concrete item objects.
     *
     * @return array
     */
    protected function getCurrentlyAvailableSelectionItems()
    {
        $selectionItems = $this->getSelectionItems();

        return $this->arrayToItems($selectionItems);
    }

    /**
     * Receives an array specifying the item sources for this control.
     *
     * @param array $items
     * @return $this
     */
    public function setSelectionItems(array $items)
    {
        $this->selectionItems = $items;

        $this->model->selectionItems = $this->getCurrentlyAvailableSelectionItems();

        return $this;
    }

    protected function supportsMultipleSelection()
    {
        return false;
    }

    /**
     * Override this function to get a label for a selected item.
     *
     * This is normally only called for the initial render of the page as during searching the labels are already
     * available. Also there is no sensible default implementation for this function as the meaning of $item
     * is known only to the overriding class.
     *
     * @param $item
     * @return string
     */
    protected function getLabelForItem($item)
    {
        return "";
    }

    protected function updateAvailableSelectionItems($itemId)
    {

    }

    /**
     * Override this function to get the data associated with a selected model item.
     *
     * By default this will use all the public data however for efficiency you can return a specific
     * array of values.
     *
     * @param $item
     * @return string[]
     */
    protected function getDataForItem($item)
    {
        if ($item instanceof Model) {
            return $item->exportPublicData();
        }

        return [];
    }

    protected function isValueSelectable($value)
    {
        if ($value === null) {
            return false;
        }

        return true;
    }

    /**
     * If your selection control works with models, this function should return
     * the appropriate model for a selected value.
     *
     * @param $value
     * @return mixed
     */
    protected function convertValueToModel($value)
    {
        return $value;
    }

    public function setSelectedItems($rawItems)
    {
        if (is_object($rawItems)) {
            if ($rawItems instanceof Model) {
                $rawItems = [$rawItems->UniqueIdentifier];
            }
        } else {
            if (is_int($rawItems) || is_bool($rawItems)) {
                $rawItems = [$rawItems];
            } elseif (!is_array($rawItems)) {
                $rawItems = explode(",", $rawItems);
            }
        }

        $selectedItems = [];

        foreach ($rawItems as $value) {
            if (!$this->isValueSelectable($value)) {
                continue;
            }

            if ($value === 0 || $value === "0") {
                $item = $this->makeItem($value, "", []);
            } else {
                if (!$value instanceof Model) {
                    $value = $this->convertValueToModel($value);
                }

                $item = $this->makeItem($this->getValueForItem($value), $this->getLabelForItem($value), $this->getDataForItem($value));
            }

            $selectedItems[] = $item;
        }

        $this->model->value = $selectedItems;
        $this->model->selectedItems = $selectedItems;
    }

    protected function getValueForItem($value)
    {
        return ($value instanceof Model) ? $value->UniqueIdentifier : $value;
    }

    public function setValue($bindingValue)
    {
        if (!is_array($bindingValue)){
            $bindingValue = [$bindingValue];
        }

        $this->setSelectedItems($bindingValue);
    }

    public function getValue()
    {
        if ($this->supportsMultipleSelection()){
            // Value will be an array
            return $this->buildDataArrayFromSelectedList($this->model->value);
        } else {
            return $this->model->value;
        }
    }

    private function buildDataArrayFromSelectedList($list)
    {
        $data = [];

        foreach ($list as $key => $value) {
            if (is_object($value)) {
                $value = $value->value;
            } elseif (is_array($value)) {
                $value = $value["value"];
            }

            $data[$key] = $value;
        }

        return $data;
    }

    /**
     * Makes a stdClass to represent an item.
     *
     * This will make a standard object with the following properties:
     *
     * Value: The value of the item
     * Label: A text display value for the item
     * Data: Any other associated item data
     *
     * Note that these properties are UpperCamelCase as these objects are often converted directly into
     * Javascript objects and that best matches our current javascript styles.
     *
     * @param $value
     * @param $label
     * @param $data
     * @return \stdClass
     */
    protected final function makeItem($value, $label, $data = [])
    {
        $item = new \stdClass();
        $item->value = $value;
        $item->label = $label;
        $item->data = $data;

        return $item;
    }
}
