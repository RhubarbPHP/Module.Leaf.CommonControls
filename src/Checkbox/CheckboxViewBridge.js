/*
 * Copyright (c) 2016 RhubarbPHP.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

var bridge = function (presenterPath) {
    window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {

};

bridge.prototype.setValue = function (value) {
    this.viewNode.checked = (value || value == 1);
};

bridge.prototype.getValue = function () {
    if (this.viewNode.checked) {
        return this.viewNode.value;
    }
    else {
        return false;
    }
};

bridge.spawn = function (spawnSettings, viewIndex, parentPresenterPath) {
    var checkbox = document.createElement('input');
    checkbox.setAttribute('type', 'checkbox');
    checkbox.setAttribute('value', '1');
    checkbox.setAttribute('checked', spawnSettings.Checked);

    for (var i in spawnSettings.Attributes) {
        checkbox.setAttribute(i, spawnSettings.Attributes[i]);
    }

    window.rhubarb.viewBridgeClasses.ViewBridge.applyStandardAttributesToSpawnedElement(checkbox, spawnSettings, viewIndex, parentPresenterPath);

    return checkbox;
};

bridge.prototype.getCssDisplayType = function () {
    return 'inline-block';
};

window.rhubarb.viewBridgeClasses.CheckboxViewBridge = bridge;
