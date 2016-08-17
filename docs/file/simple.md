SimpleFileUpload
================

The SimpleFileUpload control allows users to easily upload files in an intuitive way, and
provides the temporary filename for a developer to store the uploaded file to a server.


``` demo[examples/FileUpload/SimpleFileUploadExample.php]
```

<br>
While it is possible for this uploaded file to be saved to a database (in the same way any file would be saved),
 there is an argument for not saving the file there; instead they could be saved to the machine and part of a filepath could be stored in the database in order to access
 the file - note that only part of the path should be stored, for security reasons. If only part of the path
 is stored it is a lot harder for an attacker to gain information about the project's structure, and it is simple to have your
 code concatenate strings of constants for directories with the stored filenames in order to access them.
<br>
<br>
<br>

Described below is an example of the changes (to the View class in the example above) necessary to have the uploaded file contents automatically saved to your database.
<br>
``` php
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
            $newObjectOfClassWithTable = new ClassWithTable();
            $newObjectOfClassWithTable->UploadedFile = $content;
            $newObjectOfClassWithTable->save();
        });
    }

    protected function printViewContent()
    {
        print $this->leaves["example"];
        print $this->leaves["sampleButton"];

        ?><p><?=$this->model->displayInfo;?></p><?php
    }
}
```
<br>
As shown, the only change needed is to the 'createSubLeaves()' function - in the fileUploaded Event Handler we can create a new object of
the class whose Model generates the table you want to save. Now that we have a new object of this type we can assign, to a property of it,
the content of the uploaded file and then use object->save(), which will create a new row in the table with the file contents included.
<br><br>
In the example above, an object of the class 'ClassWithTable' is created (and named $newObjectOfClassWithTable), and then the uploaded file
is assigned to the UploadedFile field of $newObjectOfClassWithTable. Then, with $newObjectOfClassWithTable->save(), a new row is created in the table associated
with ClassWithTableModel, with the value of the UploadedFile column entry being the uploaded file.