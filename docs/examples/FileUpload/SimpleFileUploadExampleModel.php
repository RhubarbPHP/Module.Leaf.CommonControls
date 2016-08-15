<?php

namespace Rhubarb\Leaf\Controls\Common\FileUpload;


use Rhubarb\Leaf\Leaves\LeafModel;

class SimpleFileUploadExampleModel extends LeafModel
{
    public $displayInfo = "";
    public $shouldDisplay = false;
    
    /**
     * SimpleFileUploadExampleModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->displayInfo = "";
        $this->shouldDisplay = false;
    }
}