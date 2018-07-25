# Changelog

### 1.1.0

* Added:    getDefaultDoubleClickPreventor added to ButtonViewBridge as a pattern for implementing
            double button push prevention.

### 1.0.41

* Fixed:   Function with private access made protected

### 1.0.40

* Fixed:   Suppressed keyboard actions for closed search controls 

### 1.0.39

* Fixed:    Fix for leafIndex path updating.

### 1.0.38

* Added:    ButtonPressedCancelled client event added to Button

### 1.0.37

* Fixed:    Bug where checkboxes printed with index didn't send false when they were unchecked.  

### 1.0.36

* Added:    Disabling radio buttons is now a thing

### 1.0.35

* Added:    TextBoxViewBridge now provides means to do keyUp in the same pattern as keyPressed

### 1.0.34

* Changed:  datetime control display
* Fixed:    bug in datetime control viewbridge which prevented date setting

### 1.0.33

* Fixed:    output buffering issue in datetime control

### 1.0.32

* Fixed:    disable hours and minutes when datetime control is disabled

### 1.0.31

* Added:    DateTime control
* Changed:  Made Date control more readily extensible

### 1.0.30

* Fixed:    Restored updateAvailableSelectionItemsEvent for selection controls

### 1.0.29

* Fix:	    Missing upload model property

### 1.0.28

* Change:   SimpleFileUpload now supports return response from server to client as event responses

### 1.0.27

* Added:    NumericTextBox now strips commas (and other non digit characters) from the value.

### 1.0.26

* Change:   Added a span around check set labels

### 1.0.25

* Added:    Failed uploads now throw exceptions

### 1.0.24

* Added:    Added maxFileSize to SimpleFileUpload

### 1.0.23

* Fixed:    Error when using NumericTextBox due to its model not having the $type property
* Changed:  Set numeric textbox to use "tel" type so it gives a numeric textpad on mobile without showing up/down arrows in chrome

### 1.0.22

* Added:    The HTML type of a Button can be changed from default "submit"

### 1.0.21

* Fixed:    AJAX checkbox value parsing

### 1.0.20

* Fixed:    Drop downs now reattach properly from a server side refresh

### 1.0.19

* Fixed:    PasswordTextBox now sets input type the new way TextBox uses it

### 1.0.18

* Added:    Allowing setting of textbox input type

### 1.0.17

* Fixed:    Some remnant issues from jquery being pulled out.

### 1.0.16

* Added:    Hours need to be padded to match value in dropdown

### 1.0.15

* Added:    Added a ViewBridge to Hidden leaf

### 1.0.14

* Added:    Hidden input control

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
