var searchControl = function (leafPath) {
    if (arguments.length) {
        // Construct the search interface first so the when attachEvents is called, we have elements to attach to.
        this.createDom();
    }

    window.rhubarb.viewBridgeClasses.SelectionControlViewBridge.apply(this, arguments);

    this.supportsMultipleSelection = false;

    if (arguments.length) {

        // Attach interface
        this.attachSearchInterfaceToDom();

        var count = 0;

        if (this.model.selectedItems) {
            for (var value in this.model.selectedItems) {
                count++;
            }
        }

        if (count) {
            // Simulate selecting an item to ensure all other UI elements
            // update consistently between first page load and subsequent
            // selects.
            this.setSelectedItems(this.model.selectedItems);
        }
        else {
            // Valid states will be:
            // unselected
            // searching
            // searched
            // selected
            // not-searching is special and will change the state to unselected or selected based on whether a value
            // has been selected.
            this.changeState('not-searching');

            /**
             * Tracks the index of the item currently active due to keyboard input.
             *
             * -1 means no selection.
             *
             * @type {number}
             */
            this.keyboardSelection = -1;

            this.searchResults = [];

            if (this.model.focusOnLoad) {
                this.phraseBox.focus();
            }
        }
    }

    if (arguments.length) {
        // Set the default width of the search control.
        this.setWidth(200);
    }
};

searchControl.prototype = new window.rhubarb.viewBridgeClasses.SelectionControlViewBridge();
searchControl.prototype.constructor = searchControl;

searchControl.prototype.attachSearchInterfaceToDom = function(){
    this.viewNode.insertAdjacentHTML('afterend',this.interfaceContainer)
};

searchControl.prototype.createDom = function () {
    this.interfaceContainer = document.createElement("div");
    this.interfaceContainer.classList.add('search-control');

    this.phraseBox = document.createElement("input");
    this.phraseBox.classList.add("phrase-box");
    this.phraseBox.setAttribute("type", "text");

    this.selectedLabel = document.createElement("span");
    this.clearButton = document.createElement("input");
    this.clearButton.setAttribute("type", "button");
    this.clearButton.value = 'Clear';

    this.resultsList = document.createElement("tbody");

    this.resultsTable = document.createElement("table");
    this.resultsTable.setAttribute("width", "100%");
    this.resultsTable.classList.add("results-list");
    this.resultsTable.appendChild(this.resultsList);

    this.resultsContainer = document.createElement("div");
    this.resultsContainer.classList.add("results");
    this.resultsContainer.classList.add("drop-down");
    this.resultsContainer.style.zIndex = 1000;

    this.buttonsContainer = document.createElement("div");
    this.buttonsContainer.classList.add("button-container");
    this.buttonsContainer.classList.add("inline");

    this.resultsContainer.appendChild(this.resultsTable);
    this.buttonsContainer.appendChild(this.clearButton);

    this.resultsContainer.style.display = "none";

    this.interfaceContainer.appendChild(this.phraseBox);
    this.interfaceContainer.appendChild(this.selectedLabel);
    this.interfaceContainer.appendChild(this.buttonsContainer);
    this.interfaceContainer.appendChild(this.resultsContainer);
    this.onCreateDom();
};

searchControl.prototype.onCreateDom = function () {
};

searchControl.prototype.setWidth = function (width) {
    this.phraseBox.offsetWidth = width + 20;

    if (this.model.resultsWidth == "match") {
        this.resultsContainer.offsetWidth = this.phraseBox.offsetWidth + 10;
    }
    else {
        this.resultsContainer.style.width = this.model.resultsWidth;
    }

    this.resultsContainer.offsetHeight = width;
};

searchControl.prototype.setValue = function (value) {
    if (this.viewNode && ( "value" in this.viewNode )) {
        this.viewNode.value = value;
    }

    if (value == "" || value == "0") {
        this.changeState('unselected');
        this.phraseBox.value = '';
    }
    else {
        this.selectedLabel.innerText = "Retrieving...";
        var self = this;

        this.raiseServerEvent("getItemForSingleValue", value, function (item) {
            self.setSelectedItems([item]);
            self.valueChanged();
        });

        this.changeState('selected');
    }
};

searchControl.prototype.hasKeyboardSelection = function () {
    return ( this.keyboardSelection > -1 );
};

searchControl.prototype.attachEvents = function () {
    var self = this;

    this.phraseBox.addEventListener('keypress', function (e) {
        if (e.keyCode == 13) {
            if (self.hasKeyboardSelection()) {
                self.keyboardSelect();
            }
            else {
                self.submitSearch();
            }

            e.preventDefault();
            return false;
        }
    });

    this.phraseBox.addEventListener('keydown', function (e) {
        if (e.keyCode == 38) {
            self.keyboardUp();
            return false;
        }

        if (e.keyCode == 40) {
            self.keyboardDown();
            return false;
        }
    });


    this.phraseBox.addEventListener('keyup',function (e) {
        // We aren't interested in a range of characters that can't have any affect on search results and we
        // need to make sure they don't trigger auto search if supported below.
        if (e.keyCode == 37 || e.keyCode == 39 || e.keyCode == 38 || e.keyCode == 40 || e.keyCode == 13) {
            return true;
        }

        // If the setting to auto search is true, start a timer that will initiate the search.
        if (self.model.autoSubmitSearch) {
            if (self.autoSearchTimer) {
                clearTimeout(self.autoSearchTimer);
            }

            if (self.model.minimumPhraseLength) {
                if (self.phraseBox.val().length < self.model.minimumPhraseLength) {
                    return;
                }
            }

            self.autoSearchTimer = setTimeout(function () {
                self.submitSearch()
            }, 300);
        }
    });


    this.clearButton.click(function () {
        //self.setSelectedValueAndLabel( "", "" );

        self.changeState('unselected');

        self.phraseBox.focus().select();

        self.onClearPressed();
    });

    document.addEventListener('click', function (e) {
        // If the user has clicked outside of the control elements we make sure the search results
        // are closed.
        var parentNode = e.target.parentNode;
        var insideSearch = false;
        while(parentNode != null){
            if (parentNode == self.interfaceContainer){
                insideSearch = true;
                break;
            }
        }
        if (!insideSearch) {
            self.resultsContainer.hide();
        }
    });
};

searchControl.prototype.keyboardSelect = function () {
    // Get the item represented by index and call itemDomSelected
    this.itemDomSelected(this.resultsList.childNodes[this.keyboardSelection]);
};

searchControl.prototype.keyboardUp = function () {
    this.keyboardSelection--;

    if (this.keyboardSelection < -1) {
        this.keyboardSelection = -1;
    }

    this.highlightKeyboardSelection();
};

searchControl.prototype.keyboardDown = function () {
    this.keyboardSelection++;

    if (this.keyboardSelection >= this.searchResults.length) {
        this.keyboardSelection = this.searchResults.length - 1;
    }

    this.highlightKeyboardSelection();
};

searchControl.prototype.highlightKeyboardSelection = function () {
    for(var i = 0; i<this.resultsList.childNodes.length; i++){
        this.resultsList.childNodes[i].classList.remove('active');
    }

    if (this.keyboardSelection < 0) {
        return;
    }

    this.resultsList.childNodes[this.keyboardSelection].classList.add('active');
};

searchControl.prototype.changeState = function (newState) {
    if (newState == 'not-searching') {
        newState = ( this.viewNode.value != '' && this.viewNode.value != '0' ) ? 'selected' : 'unselected';
    }

    this._state = newState;
    this.updateUiState();
};

searchControl.prototype.updateUiState = function () {
    this.phraseBox.style.display = 'none';
    this.clearButton.style.display = 'none';
    this.selectedLabel.style.display = 'none';
    this.resultsContainer.style.display = 'none';
    this.phraseBox.classList.remove("phrase-box-searching");

    switch (this._state) {
        case "unselected":
            this.phraseBox.style.display = 'block';
            break;
        case "searching":
            this.phraseBox.classList.add("phrase-box-searching");
            this.phraseBox.style.display = 'block';
            this.resultsContainer.style.display = 'block';
            break;
        case "searched":
            this.phraseBox.style.display = 'block';
            this.resultsContainer.style.display = 'block';
            break;
        case "selected":
            this.selectedLabel.style.display = 'block';
            this.clearButton.style.display = 'block';
            break;
    }

    // If the ui state is updating then a significant update to our model has happened and we should
    // void any keyboard selection
    this.keyboardSelection = -1;
    this.highlightKeyboardSelection();
};

searchControl.prototype.onClearPressed = function () {
};

searchControl.prototype.onCancelPressed = function () {
};

searchControl.prototype.submitSearch = function () {
    this.resultsList.innerHTML = '';
    this.changeState('searching');

    var phrase = this.phraseBox.value;
    this.beforeSearchSubmitted(phrase);

    var self = this;

    this.raiseServerEvent('searchPressed', phrase, function (result) {
        self.changeState('searched');
        self.onSearchResultsReceived(result);
    });
};

searchControl.prototype.beforeSearchSubmitted = function (phrase) {

};

searchControl.prototype.onSearchResultsReceived = function (items) {
    this.keyboardSelection = -1;
    this.highlightKeyboardSelection();

    this.searchResults = items;
    this.resultsList.html('');

    for (var i in items) {
        var item = items[i];
        var itemDom = this.createResultItemDom(item);

        this.resultsList.appendChild(itemDom);
    }
};

searchControl.prototype.getItemLabel = function (itemData) {
    return itemData[1];
};

searchControl.prototype.createItemLabelDom = function (labelString) {
    return labelString;
};

searchControl.prototype.itemDomSelected = function (itemDom) {
    var item = itemDom.data;
    this.setSelectedItems([item]);
    this.valueChanged();
};

searchControl.prototype.setSelectedItems = function (items, raiseServerEvent) {
    window.rhubarb.viewBridgeClasses.SelectionControlViewBridge.prototype.setSelectedItems.apply(this, arguments);

    for (var value in items) {
        var item = items[value];
        var labelDom = this.createItemLabelDom(item.label);
        var self = this;

        this.selectedLabel.innerHTML = labelDom;

        this.setInternalValue(item.value);

        if (raiseServerEvent) {
            this.raiseServerEvent('itemSelected', item, function (result) {
                self.itemSelected(result);
            });
        }

        break;
    }
};

searchControl.prototype.itemSelected = function (result) {

};

searchControl.prototype.setInternalValue = function (value) {
    this.viewNode.value = value;
    this.changeState('selected');
};

searchControl.prototype.createResultItemDom = function (item) {
    var itemDom = document.createElement('tr');
    itemDom.classList.add("-item");

    for (var i = 0; i < this.model.resultColumns.length; i++) {
        var column = this.model.resultColumns[i];

        if (typeof item.data[column] != 'undefined') {
            var td = document.createElement('td');
            td.apppendChild(document.createTextNode(item.data[column]));
            itemDom.appendChild(td);
        }
        else {
            itemDom.appendChild(document.createElement('td'));
        }
    }

    itemDom.value = item.value;
    itemDom.data = item;

    var self = this;

    // This would be more efficient as an event on the outer list, however that would mean knowing the correct
    // child selector which might change and also fragments the code a little.
    itemDom.addEventListener('click', function () {
        self.itemDomSelected(this);
    });

    return itemDom;
};

window.rhubarb.viewBridgeClasses.SearchControl = searchControl;
