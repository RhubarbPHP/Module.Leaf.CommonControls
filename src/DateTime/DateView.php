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
            $date = $this->model->value;
            $checked = $date != null && $date->isValidDateTime();
            print '<input type="checkbox" name="'.$this->model->leafPath.'_enabled" id="'.$this->model->leafPath.'_enabled" value="1"'.($checked ? ' checked' : '').' />';

            $disabled = $checked ? '' : ' disabled';
        }
        ?>
        <select<?= $disabled; ?> name="<?= $this->model->leafPath; ?>_day" id="<?= $this->model->leafPath; ?>_day"><?php $this->printDays(); ?></select>
        <select<?= $disabled; ?> name="<?= $this->model->leafPath; ?>_month" id="<?= $this->model->leafPath; ?>_month"><?php $this->printMonths(); ?></select>
        <select<?= $disabled; ?> name="<?= $this->model->leafPath; ?>_year" id="<?= $this->model->leafPath; ?>_year"><?php $this->printYears(); ?></select>
        <?php
    }

    protected function parseRequest(WebRequest $request)
    {
        $path = $this->model->leafPath;

        $value = $request->post($path . "_day");
        if ($value !== null) {
            if ($this->model->optional && !$request->post($path . "_enabled")) {
                return null;
            }

            $date = new RhubarbDate($request->post($path . "_year") . "-" . $request->post($path . "_month") . "-" . $request->post($path . "_day"));
            $this->model->setValue($date);
        } else {
            $value = $request->post($path);
            if ($value !== null) {
                $date = new RhubarbDate($value);
                $this->model->setValue($date);
            }
        }
    }

    private function printDays()
    {
        $date = $this->model->value;
        $day = ($date != null) ? $date->format("d") : null;

        for ($i = 1; $i <= 31; $i++) {
            $selected = ($day == $i) ? ' selected' : '';
            print "<option value=\"$i\"$selected>$i</option>";
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
        $date = $this->model->value;
        $year = ($date != null) ? $date->format("Y") : null;

        for ($i = $this->model->minYear; $i <= $this->model->maxYear; $i++) {
            $selected = ($year == $i) ? ' selected' : '';
            print "<option value=\"$i\"$selected>$i</option>";
        }
    }
}
