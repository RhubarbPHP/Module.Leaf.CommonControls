SimpleFileUpload
================

The SimpleFileUpload control provides the familiar and standard HTML file upload box.


``` demo[examples/FileUpload/SimpleFileUploadExample.php]
```

The file details are passed to the view containing the control by register a handler on its
`fileUploadedEvent`:

``` php
class ProfileView extends View
{
    protected function createSubLeaves()
    {
        $this->registerSubLeaf(
            $upload = new SimpleFileUpload("Avatar"),
            $displayInfoButton = new Button("UpdateProfile", "Save Profile")
        );

        $upload->fileUploadedEvent->attachHandler(function(UploadedFileDetails $fileDetails){
            // $fileDetails->originalFilename
            // $fileDetails->tempFilename
        });
    }
}
```

The `UploadedFileDetails` class has two properties:

originalFilename
:   The name the file was called on the user's device
tempFilename
:   The location of the file now stored on the server

Failed uploads do not trigger the handler.

## Saving Strategies

For a normal upload like this it's common that the file is relevant to the
other fields on the page and needs processed and attached to that data.

The normal strategy then is not to do anything with the uploaded file at
this point but simply park it into a variable somewhere for the main
page save handler to pick up:
``` php
class ProfileView extends View
{
    private $uploadedFile = null;

    protected function createSubLeaves()
    {
        $this->registerSubLeaf(
            $upload = new SimpleFileUpload("Avatar"),
            $displayInfoButton = new Button("UpdateProfile", "Save Profile", function(){
                // Button events always are kept to the end of the event processing chain
                // and so by now if a file was uploaded the details will be in
                // $this->uploadedFile
                $this->model->updateProfileEvent->raise($this->uploadedFile);
            })
        );

        $upload->fileUploadedEvent->attachHandler(function(UploadedFileDetails $fileDetails){
            // Thanks for letting me know about the file! Let's park this so that the 
            // button event above can find it.
            $this->uploadedFile = $fileDetails;
        });
    }
}
```