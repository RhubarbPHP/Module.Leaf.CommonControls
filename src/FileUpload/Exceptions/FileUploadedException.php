<?php

namespace Rhubarb\Leaf\Controls\Common\FileUpload\Exceptions;

use Rhubarb\Crown\Exceptions\RhubarbException;

class FileUploadedException extends RhubarbException
{
    /**
     * @var array
     */
    private $uploadDetails;

    public function __construct($privateMessage = "", $uploadDetails, \Exception $previous = null)
    {
        parent::__construct($privateMessage, $previous);

        $this->uploadDetails = $uploadDetails;
    }

    /**
     * @return array
     */
    public function getUploadDetails()
    {
        return $this->uploadDetails;
    }
}