Selection Control Pattern
=========================

A selection control at its most basic is a means to select one or more items from a larger set.

The common control module contains a number of common variants:

DropDown
:   A standard select control

MultiSelectDropDown
:   A select control allowing multiple selections

CheckSet
:   A list of checkboxes

RadioButtons
:   A presentation of radio buttons

SearchControl
:   For selecting items from large collections this allows you to search
    a back end store via XHR requests
    
## Defining the list of Items    

All selection controls extend SelectionControl and receive a set of available items to
present by calling `setSelectionItems()`. This function receives an array that can
contain a whole range of different structures which define the list of items.

To demonstrate the various ways to configure items we'll use the `DropDown` control.

### Defining Fixed Items

The most simple structure is an array of strings:

``` demo[examples/SelectionControls/ItemsByString.php,ItemsByStringView.php]
```

Populated this way, the values of the items are the same as the labels, so the bound
value in this example would be Item 1, Item 2 etc.

To have different values from the labels you need to move from a simple string to an
array with two values - the first is the value and the second is the label.

``` demo[examples/SelectionControls/ItemsByArray.php,ItemsByArrayView.php]
```

In this example the first two items in the drop down have different values from the text
shown in the drop down. Inspect the DOM element in your developer tools to confirm this.

#### Option groups

Some selection controls support the concept of option groups - a simple way to group
related options. Do this by having sub arrays of options keyed by the group name:

``` demo[examples/SelectionControls/ItemsByGroup.php,ItemsByGroupView.php]
```

### Defining Items from Collections

Pass a collection to have the items created by iteration over the collection.

``` demo[examples/SelectionControls/ItemsByCollection.php,ItemsByCollectionView.php]
```

> Make sure your Stem Model's schema has a `labelColumnName` defined otherwise the
> selection control won't know how to source the label for the item.

### Defining Items from an Enum Column

To present items that stay in-sync with the available possibilities in a model
schema's Enum column you can pass a reference to the column schema object.

``` demo[examples/SelectionControls/ItemsByEnum.php,ItemsByEnumView.php]
```

This is most useful for driving search options in a list screen or presenting
data input fields in a CRUD add/edit screen.

### Mixing Definition Methods

All three methods can be mixed in the same configuration:

``` demo[examples/SelectionControls/ItemsByMixed.php,ItemsByMixedView.php]
```