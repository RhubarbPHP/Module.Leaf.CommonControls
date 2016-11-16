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

namespace Rhubarb\Leaf\Controls\Common\SelectionControls\SearchControl;

use Rhubarb\Leaf\Controls\Common\SelectionControls\SelectionControl;
use Rhubarb\Stem\Models\Model;

/**
 * A control presenter that forms the base for controls that require an event based search followed by selection.
 *
 * @property bool $AutoSubmitSearch Set to true to cause the search to happen on keypress.
 * @property int $MinimumPhraseLength If set, the number of characters required before a search can occur.
 */
abstract class SearchControl extends SelectionControl
{
    /**
     * @var SearchControlModel
     */
    protected $model;

    /**
     * Sets the width of the results panel.
     *
     * This is passed verbatim to the javascript width style so you can pass "150px" and "80%".
     *
     * There is one special case, "match" which the javascript will understand as making the results container
     * match the width of the search box.
     *
     * @param $width
     */
    public function setResultsWidth($width)
    {
        $this->model->resultsWidth = $width;
    }

    protected function isValueSelectable($value)
    {
        // Search controls are often bound to int columns where the default value will be zero.
        // This should not be considered a selected item.
        if ($value === "0" || $value === 0) {
            return false;
        }

        return parent::isValueSelectable($value);
    }

    protected function onModelCreated()
    {
        parent::onModelCreated();

        $model = $this->model;
        $model->resultColumns = $this->getResultColumns();
        $model->searchPressedEvent->attachHandler(function($phrase){
            $this->model->searchPhrase = $phrase;
            return $this->getCurrentlyAvailableSelectionItems();
        });

        $model->itemSelectedEvent->attachHandler(function($selectedId){
            $this->model->value = [$selectedId];

            return $selectedId;
        });

        $model->getItemForSingleValueEvent->attachHandler(function($value){
            $value = $this->convertValueToModel($value);
            $optionValue = ($value instanceof Model) ? $value->UniqueIdentifier : $value;

            $item = $this->makeItem($optionValue, $this->getLabelForItem($value), $this->getDataForItem($value));

            return $item;
        });
    }

    protected function createModel()
    {
        return new SearchControlModel();
    }

    protected abstract function getResultColumns();

    protected function getViewClass()
    {
        return SearchControlView::class;
    }
}
