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
        &nbsp;&nbsp;<select{$disabled} name="{$this->model->leafPath}_hour" id="{$this->model->leafPath}_hour">
HTML;
        $this->printHours();
        print <<<HTML
        </select> :
        <select{$disabled} name="{$this->model->leafPath}_minute" id="{$this->model->leafPath}_minute">
HTML;
        $this->printMinutes();
        print '</select>';
    }

    protected function printHours()
    {
        $this->printSimpleOptions(0, 23, 'H', function ($value) {
            return $this->timeFormatter($value);
        });
    }

    protected function printMinutes()
    {
        $this->printSimpleOptions(0, 59, 'i', function ($value) {
            return $this->timeFormatter($value);
        });
    }

    private function timeFormatter($value) {
        return str_pad($value, 2, 0, STR_PAD_LEFT);
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
