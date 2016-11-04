# Changelog

### 1.0.*

### 1.0.13

* Added:    Included a setter to control whether xhr support is enabled

### 1.0.12

* Fixed:    id on the DropDown view not using the correct id when multiple
            selection is enabled

### 1.0.11

* Added:    Added Multi Select Leaf

### 1.0.10

* Added:    Added reset ability to the Simple File Uploader

### 1.0.9

* Fixed:    Bug which prevented checkbox values from being unset
* Added:    Missing changelog entries

### 1.0.8

* Added:    checkbox to allow specifying whether the date dropdowns should be used or not
* Fixed:    Defaulted Date's "optional" setting to false to retain past behaviour in existing systems.
* Added:    Setter for the property optional Date property

### 1.0.7

* Fixed:    Bug which prevented checkbox values from being unset

### 1.0.6

* Fixed:	Made it possible for extenders of SimpleFileUpload to upload using events with response values.

### 1.0.5

* Fixed:	Changed Log Format
* Fixed: 	Now respects origin leaf

### 1.0.4

* Added:	    SimpleFileUpload::setAcceptedFileTypes() provided for file uploads

### 1.0.3

* Fixed:      Checkboxes now handle being printed with a view index

### 1.0.2

* Fixed:	    Selection controls now pass supportsMultipleSelection to their view bridge 

### 1.0.1

* Fixed:      Date control ajax value support

### 1.0.0

* Fixed:      Button callbacks can now return a response to client side event when called via XHR
* Fixed:      View index passed as argument to button XHR request
* Added:      ViewBridge.unSelectItemWithValue to allow removing of selected items using their value
