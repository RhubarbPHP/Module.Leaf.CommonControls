<?php

namespace Rhubarb\Leaf\Controls\Common\DateTime;

use Rhubarb\Crown\DateTime\RhubarbDateTime;
use Rhubarb\Crown\Request\WebRequest;

class DateTimeView extends DateView
{
    public function getDeploymentPackage()
    {
        $package = parent::getDeploymentPackage();
        $package->resourcesToDeploy[] = __DIR__ . '/DateTimeViewBridge.js';
        return $package;
    }

    protected function getViewBridgeName()
    {
        return 'DateTimeViewBridge';
    }

    protected function printViewContent()
    {
        parent::printViewContent();
        $disabled = $this->isEnabled() ? '' : ' disabled';
        print <<<HTML
        <select{$disabled} name="{$this->model->leafPath}_hour" id="{$this->model->leafPath}_hour">
HTML;
        $this->printHours();
        print <<<HTML
        </select>
        <select{$disabled} name="{$this->model->leafPath}_minute" id="{$this->model->leafPath}_minute">
HTML;
        $this->printMinutes();
        print '</select>';
    }

    protected function printHours()
    {
        $this->printSimpleOptions(0, 23, 'G');
    }

    protected function printMinutes()
    {
        $date = $this->model->value;
        $formattedDate = ($date != null) ? intval($date->format('i')) : null;

        for ($minuteIterator = 0; $minuteIterator <= 59; $minuteIterator++) {
            $selected = ($formattedDate == $minuteIterator) ? ' selected' : '';
            print "<option value='{$minuteIterator}'{$selected}>{$minuteIterator}</option>";
        }
    }

    protected function getValueClass()
    {
        return RhubarbDateTime::class;
    }

    protected function createTimeStringFromRequest(WebRequest $request)
    {
        return $request->post($this->model->leafPath . '_year') . '-' .
            $request->post($this->model->leafPath . '_month') . '-' .
            $request->post($this->model->leafPath . '_day') . ' ' .
            $request->post($this->model->leafPath . '_hour') . ':' .
            $request->post($this->model->leafPath . '_minute') . ':00';
    }
}
