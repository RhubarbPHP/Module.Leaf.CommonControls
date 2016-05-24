var radioButtonsViewBridge = function (leafPath) {
    window.rhubarb.viewBridgeClasses.SelectionControlViewBridge.apply(this, arguments);

    this.supportsMultipleSelection = false;
};

radioButtonsViewBridge.prototype = new window.rhubarb.viewBridgeClasses.SelectionControlViewBridge();
radioButtonsViewBridge.prototype.constructor = radioButtonsViewBridge;

radioButtonsViewBridge.prototype.setValue = function (value) {
    this.selectAndIterateElements('input[type=radio]', function(item) {
        if (item.value == value) {
            item.checked = true;
        }
    });

    this.model.selectedItems = [{"value": value}];

    this.valueChanged();
};

radioButtonsViewBridge.prototype.valueChanged = function () {
    var checkedInput = this.viewNode.querySelector("input:checked");

    if (checkedInput) {
        this.model.selectedItems = [{"value": checkedInput.value}];
    } else {
        this.model.selectedItems = [];
    }

    // Calling our parent will ensure the new value gets raised as an event
    window.rhubarb.viewBridgeClasses.SelectionControlViewBridge.prototype.valueChanged.apply(this, arguments);
};

window.rhubarb.viewBridgeClasses.RadioButtonsViewBridge = radioButtonsViewBridge;
