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

namespace Rhubarb\Leaf\Controls\Common\FileUpload;

use Rhubarb\Leaf\Leaves\Controls\ControlView;
use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;

class SimpleFileUploadView extends ControlView
{
    protected $requiresContainer = false;
    protected $requiresStateInputs = false;

    /**
     * @var SimpleFileUploadModel
     */
    protected $model;

    protected function printViewContent()
    {
        $accepts = "";

        if (sizeof($this->model->acceptFileTypes) > 0) {
            $accepts = " accept=\"" . implode(",", $this->model->acceptFileTypes) . "\"";
        }

        ?>
        <input type="file" name="<?= $this->model->leafPath; ?>" id="<?= $this->model->leafPath; ?>"
               leaf-name="<?= $this->model->leafName ?>"<?= $accepts . $this->model->getHtmlAttributes() . $this->model->getClassAttribute() ?>/>
        <?php
    }

    public function getDeploymentPackage()
    {
        return new LeafDeploymentPackage(__DIR__ . "/SimpleFileUploadViewBridge.js");
    }

    protected function getViewBridgeName()
    {
        return "SimpleFileUploadViewBridge";
    }
}
