<?php


namespace Rhubarb\Leaf\Controls\Common\FileUpload;

use Rhubarb\Leaf\Controls\Common\Buttons\Button;
use Rhubarb\Leaf\Controls\Common\Text\TextArea;
use Rhubarb\Leaf\Controls\Common\Text\TextBox;
use Rhubarb\Leaf\Views\View;

class SimpleFileUploadExampleView extends View
{
    /**
     * @var SimpleFileUploadExampleModel $model
     */
    protected $model;

    protected function createSubLeaves()
    {
        $this->registerSubLeaf(
            $upload = new SimpleFileUpload("example"),
            $displayInfoButton = new Button("sampleButton", "Display info about file")
        );
        $upload->fileUploadedEvent->attachHandler(function(UploadedFileDetails $content){
            $this->model->displayInfo = $content->originalFilename;
        });
    }

    protected function printViewContent()
    {
        print $this->leaves["example"];
        print $this->leaves["sampleButton"];
        
        ?><p><?=$this->model->displayInfo;?></p><?php
    }
}