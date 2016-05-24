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

    this.model.SelectedItems = [{"value": value}];

    this.valueChanged();
};

radioButtonsViewBridge.prototype.valueChanged = function () {
    var checkedInput = this.viewNode.querySelector("input:checked");

    if (checkedInput) {
        this.model.SelectedItems = [{"value": checkedInput.length ? checkedInput[0].value : null}];
    } else {
        this.model.SelectedItems = [];
    }

    // Calling our parent will ensure the new value gets raised as an event
    window.rhubarb.viewBridgeClasses.SelectionControlViewBridge.prototype.valueChanged.apply(this, arguments);
};

window.rhubarb.viewBridgeClasses.RadioButtonsViewBridge = radioButtonsViewBridge;
