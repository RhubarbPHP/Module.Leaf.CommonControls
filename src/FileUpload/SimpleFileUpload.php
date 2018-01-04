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

use Rhubarb\Crown\Context;
use Rhubarb\Crown\Events\Event;
use Rhubarb\Crown\Request\Request;
use Rhubarb\Crown\Request\WebRequest;
use Rhubarb\Leaf\Controls\Common\FileUpload\Exceptions\FileUploadedException;
use Rhubarb\Leaf\Leaves\Controls\Control;
use Rhubarb\Leaf\Controls\Common\ControlPresenter;

class SimpleFileUpload extends Control
{
    /**
     * Raised when a file is uploaded.
     *
     * Arguments passed are:
     *
     * A UploadedFileDetails object, the leaf index if any.
     *
     * @var Event
     */
    public $fileUploadedEvent;
    
    /**
     * @var SimpleFileUploadModel
     */
    protected $model;

    public function __construct($name)
    {
        parent::__construct($name);

        $this->fileUploadedEvent = new Event();
    }

    /**
     * Sets an array of accepted file types.
     *
     * The values should be either:
     * 1. A file extension prefixed by . e.g. .pdf
     * 2. One of the following categories of file: audio/* video/* image/*
     * 3. A valid mime file type e.g. text/plain
     *
     * @param array $filters
     */
    public function setAcceptedFileTypes($filters = [])
    {
        $this->model->acceptFileTypes = $filters;
    }

    protected function createModel()
    {
        return new SimpleFileUploadModel();
    }

    protected function onModelCreated()
    {
        parent::onModelCreated();

        $this->model->fileUploadedEvent->attachHandler(function(){

            $fileData = Request::current()->files($this->model->leafPath);
            $response = false;

            if (isset($fileData["name"]) && $fileData["name"] != '') {
                if ($fileData["error"] == UPLOAD_ERR_OK) {
                    $response = $this->fileUploadedEvent->raise(
                        new UploadedFileDetails($fileData["name"], $fileData["tmp_name"]),
                        $this->model->leafIndex
                    );
                } else {
                    throw new FileUploadedException("The file did not upload correctly", $fileData);
                }
            }

           return $response;
        });

    }


    protected function getViewClass()
    {
        return SimpleFileUploadView::class;
    }

    protected function parseRequest(WebRequest $request)
    {
        $response = $this->parseRequestForFiles($request);

        parent::parseRequest($request);

        return $response;
    }

    /**
     * @param WebRequest $request
     * @param $match
     * @return null
     */
    protected function parseRequestForFiles(WebRequest $request)
    {
        if ($request->header("Accept","") == "application/leaf"){
            return;
        }

        $files = $request->filesData;
        $response = null;

        foreach ($files as $leafPath => $fileData) {

            $targetWithoutIndexes = preg_replace('/\([^)]+\)/', "", $leafPath);
            $leafWithoutIndexes = preg_replace('/\([^)]+\)/', "", $this->model->leafPath);

            if ($targetWithoutIndexes !== $leafWithoutIndexes) {
                continue;
            }

            if (preg_match('/\(([^)]+)\)/', $leafPath, $match)) {
                $this->model->leafIndex = $match[1];
                $this->model->updatePath();
            }

            if (isset($fileData["name"]) && $fileData["name"] != '') {
                if ($fileData["error"] == UPLOAD_ERR_OK) {
                    $response = $this->fileUploadedEvent->raise(
                        new UploadedFileDetails($fileData["name"], $fileData["tmp_name"]),
                        $this->model->leafIndex
                    );
                } else {
                    throw new FileUploadedException("The file did not upload correctly", $fileData);
                }
            }
        }

        return $response;
    }
}
