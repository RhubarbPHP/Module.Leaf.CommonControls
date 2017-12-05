var button = function (leafPath) {
    this.validation = false;
    this.validator = false;
    this.confirmMessage = false;

    window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);

    if (arguments.length == 0) {
        return;
    }

    this.useXmlRpc = ( this.viewNode.getAttribute("xmlrpc") == "yes" );

    if (this.viewNode.getAttribute("confirm")) {
        this.confirmMessage = this.viewNode.getAttribute("confirm");
    }
};

button.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
button.prototype.constructor = button;

button.prototype.attachEvents = function () {
    var self = this;

    this.viewNode.addEventListener('click',function(event) {

        if (self.model.validationTree){
            var validations = [];
            var eventHost = self.findEventHost();

            for(var i = 0; i < self.model.validationTree.length; i++){
                var validationExpression = self.model.validationTree[i];
                var validation = new rhubarb.validation.validator();

                var controlViewBridge = eventHost.findViewBridge(validationExpression.key);

                validation.require()
                          .check(validationExpression.function)
                          .setSource(rhubarb.validation.sources.fromViewBridge(controlViewBridge))
                          .setTargetElement(controlViewBridge.leafPath + "_validation");

                validations.push(validation);
            }

            var allValid = new rhubarb.validation.validator();
            allValid.check(rhubarb.validation.common.allValid(validations));
            if (!allValid.validate()){
                event.preventDefault();
                return false;
            }
        }

        if (self.confirmMessage) {
            if (!confirm(self.confirmMessage)) {
                event.preventDefault();
                return false;
            }
        }

        if (self.raiseClientEvent("OnButtonPressed") === false) {
            event.preventDefault();
            return false;
        }

        if (self.useXmlRpc) {
            var viewIndex = self.getViewIndex();
            self.raiseServerEvent(
                "buttonPressed",
                viewIndex,
                function (response) {
                    self.raiseClientEvent("ButtonPressCompleted", response);
                },
                function (response) {
                    self.raiseClientEvent("ButtonPressFailed", response);
                }
            );

            event.preventDefault();
            return false;
        }

        if (self.viewNode.classList.contains('submit-on-click') && self.viewNode.getAttribute('type') == 'button') {
            self.viewNode.setAttribute('type', 'submit');
            window.setTimeout(function () {
                self.viewNode.setAttribute('type', 'button');
            }, 1);
        }
    });
};

button.prototype.getCssDisplayType = function () {
    return 'inline-block';
};

window.rhubarb.viewBridgeClasses.ButtonViewBridge = button;
