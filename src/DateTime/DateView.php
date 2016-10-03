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

class DateView extends ControlView
{
    /** @var DateModel */
    protected $model;

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
        return new LeafDeploymentPackage(__DIR__."/DateViewBridge.js");
    }

    protected function printViewContent()
    {
        parent::printViewContent();

        ?>
        <select name="<?=$this->model->leafPath;?>_day" id="<?=$this->model->leafPath;?>_day"><?php $this->printDays();?></select>
        <select name="<?=$this->model->leafPath;?>_month" id="<?=$this->model->leafPath;?>_month"><?php $this->printMonths();?></select>
        <select name="<?=$this->model->leafPath;?>_year" id="<?=$this->model->leafPath;?>_year"><?php $this->printYears();?></select>
        <?php
    }

    protected function parseRequest(WebRequest $request)
    {
        $path = $this->model->leafPath;

        // By default if a control can be represented by a single HTML element then the name of that element
        // should equal the leaf path of the control. If that is true then we can automatically discover and
        // update our model.

        $value = $request->post($path."_day");
        if ($value !== null){
            $date = new RhubarbDate($request->post($path."_year")."-".$request->post($path."_month")."-".$request->post($path."_day"));
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
        /**
         * @var RhubarbDate $date
         */
        $date = $this->model->value;
        $day = ($date != null) ? $date->format("d") : null;

        for($x = 1; $x <=31; $x++){
            $selected = ($day == $x) ? " selected=\"selected\"" : "";
            print "<option value=\"{$x}\"{$selected}>{$x}</option>";
        }
    }

    private function printMonths()
    {
        /**
         * @var RhubarbDate $date
         */
        $date = $this->model->value;
        $month = ($date != null) ? $date->format("m") : null;

        for($x = 1; $x <=12; $x++){
            $selected = ($month == $x) ? " selected=\"selected\"" : "";
            $formatted = date("M", mktime(12,1,1,$x,1,2000));
            print "<option value=\"{$x}\"{$selected}>{$formatted}</option>";
        }
    }

    private function printYears()
    {
        /**
         * @var RhubarbDate $date
         */
        $date = $this->model->value;
        $year = ($date != null) ? $date->format("Y") : null;

        for($x = $this->model->minYear; $x <= $this->model->maxYear; $x++){
            $selected = ($year == $x) ? " selected=\"selected\"" : "";
            print "<option value=\"{$x}\"{$selected}>{$x}</option>";
        }
    }
}
