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
use Rhubarb\Crown\Request\WebRequest;
use Rhubarb\Leaf\Leaves\Controls\ControlView;
use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;

/**
 * @property DateModel $model
 */
class DateView extends ControlView
{
    protected $requiresContainerDiv = true;

    /**
     * If the leaf requires a view bridge this returns it's name.
     *
     * @return string|bool
     */
    protected function getViewBridgeName()
    {
        return "DateViewBridge";
    }

    public function getDeploymentPackage()
    {
        return new LeafDeploymentPackage(__DIR__ . "/DateViewBridge.js");
    }

    protected function printViewContent()
    {
        $disabled = '';

        if ($this->model->optional) {
            $checked = $this->isEnabled();
            print '<input type="checkbox" name="'.$this->model->leafPath.'_enabled" id="'.$this->model->leafPath.'_enabled" value="1"'.($checked ? ' checked' : '').' />';

            $disabled = $checked ? '' : ' disabled';
        }
        ?>
        <select<?= $disabled; ?> name="<?= $this->model->leafPath; ?>_day" id="<?= $this->model->leafPath; ?>_day"><?php $this->printDays(); ?></select>
        <select<?= $disabled; ?> name="<?= $this->model->leafPath; ?>_month" id="<?= $this->model->leafPath; ?>_month"><?php $this->printMonths(); ?></select>
        <select<?= $disabled; ?> name="<?= $this->model->leafPath; ?>_year" id="<?= $this->model->leafPath; ?>_year"><?php $this->printYears(); ?></select>
        <?php
    }

    protected function isEnabled()
    {
        if ($this->model->optional) {
            $date = $this->model->value;
            return $date != null && $date->isValidDateTime();
        }
        return true;
    }

    protected function parseRequest(WebRequest $request)
    {
        $path = $this->model->leafPath;

        $valueClass = $this->getValueClass();

        $value = $request->post($path . "_day");
        if ($value !== null) {
            if ($this->model->optional && !$request->post($path . "_enabled")) {
                return null;
            }

            $date = new $valueClass($this->createTimeStringFromRequest($request));
            $this->model->setValue($date);
        } else {
            $value = $request->post($path);
            if ($value !== null) {
                $date = new $valueClass($value);
                $this->model->setValue($date);
            }
        }
    }

    protected function getValueClass()
    {
        return RhubarbDate::class;
    }

    protected function createTimeStringFromRequest(WebRequest $request)
    {
        return $request->post($this->model->leafPath . '_year') . '-' .
            $request->post($this->model->leafPath . '_month') . '-' .
            $request->post($this->model->leafPath . '_day');
    }

    private function printDays()
    {
        $this->printSimpleOptions(1, 31, 'd');
    }

    protected function printSimpleOptions($from, $to, $dateFormat)
    {
        $date = $this->model->value;
        $formattedDate = ($date != null) ? $date->format($dateFormat) : null;

        for ($unitIterator = $from; $unitIterator <= $to; $unitIterator++) {
            $selected = ($formattedDate == $unitIterator) ? ' selected' : '';
            print "<option value='{$unitIterator}'{$selected}>{$unitIterator}</option>";
        }
    }

    private function printMonths()
    {
        $date = $this->model->value;
        $month = ($date != null) ? $date->format("m") : null;

        for ($i = 1; $i <= 12; $i++) {
            $selected = ($month == $i) ? ' selected' : '';
            $formatted = date("M", mktime(12, 1, 1, $i, 1, 2000));
            print "<option value=\"$i\"$selected>$formatted</option>";
        }
    }

    private function printYears()
    {
        $this->printSimpleOptions($this->model->minYear, $this->model->maxYear, 'Y');
    }
}
