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

window.rhubarb.viewBridgeClasses.DateViewBridge = bridge;