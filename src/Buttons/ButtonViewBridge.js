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

/**
 * An application can register default double click prevention behaviour by
 * installing a new version of this function at a global level (this
 * intentionally does nothing by default)
 *
 * The function should return an object with two methods as described in
 * getDoubleClickPreventor()
 */
button.getDefaultDoubleClickPreventor = function(button) {
    return {
        checkIsButtonProcessing: function(){
            // Default behaviour - no double click prevention.
            return true;
        },
        processingCompleted: function(){

        }
    };
};

button.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
button.prototype.constructor = button;

/**
 * Returns an object with methods to control double click prevention.
 *
 * The object should have two functions named checkIsButtonProcessing and
 * processingCompleted.
 *
 * By default this calls the static getDefaultDoubleClickPreventor whose
 * behaviours do nothing. To apply a global prevention method an application
 * should replace that function as a catch-all.
 *
 * To change the behaviour individually you should extend the ButtonViewBridge
 * and override this method.
 *
 * checkIsButtonProcessing should return true or false; true to allow
 * processing to continue, false to stop it. At the same time it would
 * be normal to install a CSS class to demonstrate that processing is
 * underway or raise an alert if the user presses twice.
 *
 * processingCompleted should return nothing, but allows for the removal
 * of CSS properties if added in the method above.
 *
 * @returns {{checkIsButtonProcessing, processingCompleted}}
 */
button.prototype.getDoubleClickPreventor = function(){
    return button.getDefaultDoubleClickPreventor(this);
};

button.prototype.attachEvents = function () {
    var self = this;

    this.viewNode.addEventListener('click',function(event) {

        if (self.confirmMessage) {
            if (!confirm(self.confirmMessage)) {
                event.preventDefault();

                self.raiseClientEvent("ButtonPressCancelled");

                return false;
            }
        }

        if (self.raiseClientEvent("OnButtonPressed") === false) {
            event.preventDefault();
            return false;
        }

        // Is there double click prevention?
        var doubleClickPreventor = self.getDoubleClickPreventor();

        if (!doubleClickPreventor.checkIsButtonProcessing()){
            event.preventDefault();
            return false;
        }

        if (self.useXmlRpc) {
            var viewIndex = self.getViewIndex();
            self.raiseServerEvent(
                "buttonPressed",
                viewIndex,
                function (response) {
                    doubleClickPreventor.processingCompleted();
                    self.raiseClientEvent("ButtonPressCompleted", response);
                },
                function (response) {
                    doubleClickPreventor.processingCompleted();
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
