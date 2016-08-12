var bridge = function (presenterPath) {
    window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {
    var self = this,
        simpleAjaxButtonViewBridge = this.findChildViewBridge('SimpleAjaxButton');

    simpleAjaxButtonViewBridge.attachClientEventHandler('ButtonPressCompleted', function (response) {
       document.getElementById('simple-ajax-button-span').innerHTML = response;
    });
};

window.rhubarb.viewBridgeClasses.SimpleAjaxButtonViewBridge = bridge;
