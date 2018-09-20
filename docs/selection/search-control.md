SearchControl
=============

A `SearchControl` presents a search interface which then returns a list of results from the server
to allow the user to make a selection from very large data sets.

Search controls require that items have [attached data](attached-data) as the display method is traditionally a table
of results and the columns of data are mapped to the values in the attached data.

`SearchControl` is abstract and so must be extended in order to be configured correctly. This is because
knowledge of what columns to display in the results and how to apply the search cannot be automatically
determined.

``` demo[examples/SelectionControls/SearchControlExample.php,SearchControlExampleView.php,ExampleSearchControl.php,search.css]
```

This basic implementation applies the search by overriding `getCurrentlyAvailableSelectionItems()` and
filtering items that don't contain the search phrase (`$this->model->searchPhrase`). This would not scale
however to large database searches.