CheckSet
========

The `CheckSet` presents items as checkboxes.

``` demo[examples/SelectionControls/CheckSetExample.php,CheckSetExampleView.php]
```

Two variants exist `CheckSet` which outputs each checkset with a label one after the other and
`CheckSetTable` which formats the set into a table.

## Customising the view

The `CheckSetView` is quite often overridden to customise how the checkboxes are laid out.

As `CheckSet` is a `SetSelectionControl` it's view has three methods you can override:

getItemOptionHtml($value, $label, $item)
:   Returns the HTML for a given item. The result of this function is printed one after the other.
    In turn this should call the remaining two functions.
    
getInputHtml($name, $value, $item)
:   Returns the HTML for the checkbox input itself

getLabelHtml($label, $inputId)
:   Returns the HTML for the label. `$inputId` can be used to reference the input's document
    ID for example in a &lt;label for="""&gt; tag