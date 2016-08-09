var bridge = function (leafPath) {
    window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.keyPressed = function(event){
    if (this.onKeyPress){
        this.onKeyPress(event);
    }
};

bridge.prototype.setValue = function(value){
    var date = new Date(value);

    document.getElementById(this.leafPath + "_year").value = date.getFullYear();
    document.getElementById(this.leafPath + "_month").value = date.getMonth() + 1;
    document.getElementById(this.leafPath + "_day").value = date.getDate();
};

bridge.prototype.getValue = function(){
    return new Date(
        document.getElementById(this.leafPath + "_year").value,
        document.getElementById(this.leafPath + "_month").value-1,
        document.getElementById(this.leafPath + "_day").value,
        0,
        0,
        0,
        0
    );
};

bridge.prototype.getSerializableValue = function() {
    return this.getValue().toISOString();
};

bridge.prototype.hasValue = function() {
    return true;
};

window.rhubarb.viewBridgeClasses.DateViewBridge = bridge;
