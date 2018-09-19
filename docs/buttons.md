Buttons
=======

The ever reliable button is one of the common controls used throughout any web project to perform an action.

The `Button` control class has several properties in addition to the standard control:

setConfirmMessage($confirmMessage)
:   Sets the confirmation alert message that should be presented when the Button is pressed.

setButtonText($buttonText)
:   Sets the text to be displayed within the Button.

`ButtonViewBridge` Placeholder for all ButtonViewBridge Events

## Simple button

The below example will show how to implement a basic Button into your View. Once the button is pressed it update the Views
Model and will output the value that has set on the model to the screen.

``` demo[examples/SimpleButton/SimpleButton.php]
```

## Simple XHR button

The below example shows you how to implement a basic Button into your View. That utilises Ajax to be able to retrieve a response
from the Server and button an element on the page.

``` demo[examples/SimpleAjaxButton/SimpleAjaxButton.php]
```
