Attached Data
=============

Simple items are composed of a value and a label. However many user interfaces need access to
a richer set of data for items, either for higher fidelity result displays or to process
the selected item without having to perform another round trip to the server.

## Attached data for Fixed Items

When defining your items as an array you can pass a third item in the array, itself another
key/value pair array of the attached data:

```php
$dropDown->setSelectionItems([
    [1, 'John', ['Forename' => 'John', 'Surname' => 'Smith', 'Age' => 23]],
    [2, 'Jane', ['Forename' => 'Jane', 'Surname' => 'Doe', 'Age' => 33]],
    [3, 'Clover', ['Forename' => 'Clover', 'Surname' => 'Daniels', 'Age' => 43]]
]);
```

The attached data is json encoded and attached to the relevant HTML element as an extra
attribute.

## Attached data for Collections

Data is automatically attached to items created from a collection if those properties are
named in the Model's "PublicPropertyList". This is a fail safe to stop accidentally leaking
secure data into the view despite it not being 'visible' to end users.

```php
class Contact extends Model
{
    protected function getPublicPropertyList()
    {
        $list = parent::getPublicPropertyList();
        $list[] = 'FirstName';
        $list[] = 'Surname';

        return $list;
    }
}
```

The model's UniqueIdentifier and label column name are public by default.

## Using the attached data

Like any control a selection control has a `getValue()` function that returns the value
of the selected item. To get the attached data you need access to the full item structure.
Use `getSelectedItems()` to fetch the full list of selected items and from there you can
simply access the data:

````js
var items = this.findChildViewBridge('customer').getSelectedItems();
if (items.length > 0){
    alert(items[0].data.FirstName);
}
````