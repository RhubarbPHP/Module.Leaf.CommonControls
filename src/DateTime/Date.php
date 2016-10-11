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

namespace Rhubarb\Leaf\Controls\Common\DateTime;

use Rhubarb\Crown\DateTime\RhubarbDate;
use Rhubarb\Leaf\Leaves\Controls\Control;

/**
 * @property DateModel $model
 */
class Date extends Control
{
    protected function getViewClass()
    {
        return DateView::class;
    }

    protected function createModel()
    {
        return new DateModel();
    }

    public function setYearRange($min, $max)
    {
        $this->model->minYear = $min;
        $this->model->maxYear = $max;
    }

    public function setOptional($optional = true)
    {
        $this->model->optional = $optional;
    }

    public function setSensibleAgeRange()
    {
        $now = (new RhubarbDate('now'))->format('Y');
        $start = $now - 100;
        $this->setYearRange($start, $now);
    }
}
