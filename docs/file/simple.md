SimpleFileUpload
================

The SimpleFileUpload control allows users to easily upload files in an intuitive way, and
provides the temporary filename for a developer to store the uploaded file to a server.

 While it is possible for this uploaded file to be saved to a database (in the same way any file would be saved),
 there is an argument for not saving the file there; instead they could be saved to the machine and part of a filepath could be stored in the database in order to access
 the file - note that only part of the path should be stored, for security reasons. If only part of the path
 is stored it is a lot harder for an attacker to gain information about the project's structure, and it is simple to have your
 code concatenate strings of constants for directories with the stored filenames in order to access them.
``` demo[examples/FileUpload/SimpleFileUploadExample.php]
```