<?php

namespace Rhubarb\Leaf\Controls\Common\FileUpload;

use Rhubarb\Leaf\Leaves\Leaf;

class SimpleFileUploadExample extends Leaf
{
    /**
     * @var SimpleFileUploadModel
     */
    protected $model;

    public function getViewClass()
    {
        return SimpleFileUploadExampleView::class;
    }

    public function createModel()
    {
        return new SimpleFileUploadExampleModel();
    }
}

