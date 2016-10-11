var bridge = function (leafPath) {
    window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {
    this.enabledCheckbox = document.getElementById(this.leafPath + "_enabled");
    this.yearDropDown = document.getElementById(this.leafPath + "_year");
    this.monthDropDown = document.getElementById(this.leafPath + "_month");
    this.dayDropDown = document.getElementById(this.leafPath + "_day");

    if (this.enabledCheckbox) {
        this.enabledCheckbox.onclick = function () {
            this.yearDropDown.disabled = !this.enabledCheckbox.checked;
            this.monthDropDown.disabled = !this.enabledCheckbox.checked;
            this.dayDropDown.disabled = !this.enabledCheckbox.checked;
        }.bind(this);
    }
};

bridge.prototype.isEnabled = function () {
    return (this.enabledCheckbox == null || this.enabledCheckbox.checked);
};

bridge.prototype.keyPressed = function (event) {
    if (this.onKeyPress) {
        this.onKeyPress(event);
    }
};

bridge.prototype.setValue = function (value) {
    var date = new Date(value);

    this.yearDropDown.value = date.getFullYear();
    this.monthDropDown.value = date.getMonth() + 1;
    this.dayDropDown.value = date.getDate();
};

bridge.prototype.getValue = function () {
    if (!this.isEnabled()) {
        return null;
    }

    return new Date(
        this.yearDropDown.value,
        this.monthDropDown.value - 1,
        this.dayDropDown.value,
        0,
        0,
        0,
        0
    );
};

bridge.prototype.getSerializableValue = function () {
    return this.getValue().toISOString();
};

bridge.prototype.hasValue = function () {
    return this.isEnabled();
};

window.rhubarb.viewBridgeClasses.DateViewBridge = bridge;
