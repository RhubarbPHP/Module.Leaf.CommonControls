var bridge = function (leafPath) {
    window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
bridge.prototype.constructor = bridge;

bridge.spawn = function (spawnData, index, parentPresenterPath) {
    var hidden = document.createElement("INPUT");
    hidden.setAttribute("type", "hidden");

    window.rhubarb.viewBridgeClasses.ViewBridge.applyStandardAttributesToSpawnedElement(hidden, spawnData, index, parentPresenterPath);

    return hidden;
};

window.rhubarb.viewBridgeClasses.HiddenViewBridge = bridge;
