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

bridge.spawn = function (spawnSettings, viewIndex, parentPresenterPath) {
    var element = document.createElement("INPUT");
    element.setAttribute("type", "file");

    window.rhubarb.viewBridgeClasses.HtmlViewBridge.applyStandardAttributesToSpawnedElement(element, spawnSettings, viewIndex, parentPresenterPath);

    return element;
};

bridge.prototype.reset = function () {
    var form = document.createElement("FORM");
    var currentParent = this.viewNode.parentNode;
    currentParent.insertBefore(form, this.viewNode);
    form.appendChild(this.viewNode);
    form.reset();
    currentParent.insertBefore(this.viewNode, form);
    currentParent.removeChild(form);
};

window.rhubarb.viewBridgeClasses.SimpleFileUploadViewBridge = bridge;