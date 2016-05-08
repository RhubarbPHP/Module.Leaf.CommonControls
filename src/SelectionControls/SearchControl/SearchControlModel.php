<?php
/**
 * Copyright (c) 2016 RhubarbPHP.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Rhubarb\Leaf\Controls\Common\SelectionControls\SearchControl;

use Rhubarb\Crown\Events\Event;
use Rhubarb\Leaf\Controls\Common\SelectionControls\SelectionControlModel;

class SearchControlModel extends SelectionControlModel
{
    public $resultsWidth = "match";

    public $autoSubmitSearch = true;

    public $searchPhrase = "";

    public $resultColumns = [];

    public $minimumPhraseLength = 3;

    public $focusOnLoad = false;

    /**
     * @var Event
     */
    public $searchPressedEvent;

    /**
     * @var Event
     */
    public $itemSelectedEvent;

    /**
     * @var Event
     */
    public $getItemForSingleValueEvent;

    public function __construct()
    {
        parent::__construct();

        $this->searchPressedEvent = new Event();
        $this->itemSelectedEvent = new Event();
        $this->getItemForSingleValueEvent = new Event();
    }

    protected function getExposableModelProperties()
    {
        $list = parent::getExposableModelProperties();
        $list[] = "focusOnLoad";
        $list[] = "autoSubmitSearch";
        $list[] = "minimumPhraseLength";
        $list[] = "resultColumns";
        $list[] = "resultsWidth";
        return $list;
    }


}