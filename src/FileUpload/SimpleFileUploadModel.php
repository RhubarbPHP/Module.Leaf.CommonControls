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

use Rhubarb\Leaf\Leaves\Controls\ControlModel;

class SimpleFileUploadModel extends ControlModel
{
    public $acceptFileTypes = [];

    public $maxFileSize;

    public function __construct()
    {
        parent::__construct();

        $this->maxFileSize = $this->getMaximumFileUploadSize();
    }

    private function convertPhpSizeToBytes($size)
    {
        if ( is_numeric( $size) ) {
            return $size;
        }

        $suffix = substr($size, -1);
        $value = substr($size, 0, -1);
        
        switch(strtoupper($suffix)){
            case 'P':
                $value *= 1024;
            case 'T':
                $value *= 1024;
            case 'G':
                $value *= 1024;
            case 'M':
                $value *= 1024;
            case 'K':
                $value *= 1024;
                break;
        }
        return $value;
    }

    private function getMaximumFileUploadSize()
    {
        return min(
            $this->convertPhpSizeToBytes(ini_get('post_max_size')),
            $this->convertPhpSizeToBytes(ini_get('upload_max_filesize'))
        );
    }

    protected function getExposableModelProperties()
    {
        $list = parent::getExposableModelProperties();
        $list[] = "acceptFileType";
        $list[] = "maxFileSize";

        return $list;
    }
}