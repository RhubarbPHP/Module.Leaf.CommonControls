var dropDown = function (leafPath) {
    window.rhubarb.viewBridgeClasses.SelectionControlViewBridge.apply(this, arguments);

    if (!leafPath) {
        return;
    }

    this.populateSelectedItemsFromDom();

    // hasAttribute would be better - but this isn't IE 7 compatible
    this.supportsMultipleSelection = ( this.viewNode.getAttribute("multiple") != null );
};

dropDown.prototype = new window.rhubarb.viewBridgeClasses.SelectionControlViewBridge();
dropDown.prototype.constructor = dropDown;

dropDown.prototype.onReattached = function(){
    this.populateSelectedItemsFromDom();
};

dropDown.prototype.populateSelectedItemsFromDom = function(){
    // As this view bridge doesn't carry a hidden state we need to build
    // the SelectedItems.
    var selectedItems = [];

    this.selectAndIterateElements("option",function(item) {
        if (item.getAttribute("data-item") != null) {
            item.data = JSON.parse(item.getAttribute("data-item"));
        } else {
            item.data =  {value: this.value, label: this.text};
        }

        if (item.selected) {
            selectedItems.push(item.data);
        }
    });

    this.model.selectedItems = selectedItems;
};

dropDown.spawn = function (spawnSettings, viewIndex, parentPresenterPath) {
    var element = document.createElement("SELECT");

    window.rhubarb.viewBridgeClasses.HtmlViewBridge.applyStandardAttributesToSpawnedElement(element, spawnSettings, viewIndex, parentPresenterPath);

    for (var i in spawnSettings.AvailableItems) {
        var item = spawnSettings.AvailableItems[i];

        var option = document.createElement("OPTION");
        option.textContent = item.label;
        option.value = item.value;

        element.appendChild(option);
    }

    return element;
};

dropDown.prototype.valueChanged = function () {
    var selectedItems = [];

    this.selectAndIterateElements("option", function(option) {
        if (option.selected) {
            selectedItems.push(option.data);
        }
    });

    this.setSelectedItems(selectedItems);

    // Calling our parent will ensure the new value gets raised as an event
    window.rhubarb.viewBridgeClasses.SelectionControlViewBridge.prototype.valueChanged.apply(this, arguments);
};

dropDown.prototype.getDisplayView = function () {
    return this.viewNode.querySelector("option:checked").innerText;
};

dropDown.prototype.setCurrentlyAvailableSelectionItems = function (items) {
    var oldValue = this.viewNode.value;
    this.viewNode.innerHTML = '';

    for (var i in items) {
        var item = items[i];
        var itemDom = document.createElement("option");
        itemDom.value = item.value;
        itemDom.innerHTML = item.label;

        itemDom.data = item;

        this.viewNode.appendChild(itemDom);
    }

    this.viewNode.value = oldValue;
    var itemSelected = false;
    for(var j = 0; j < this.viewNode.options.length; j++){
        if (this.viewNode.options[j].selected){
            itemSelected = true;
            break;
        }
    }

    if (!itemSelected){
        if (this.viewNode.options.length > 0){
            this.viewNode.value = this.viewNode.options[0].value;
        }
    }
};

window.rhubarb.viewBridgeClasses.DropDownViewBridge = dropDown;
