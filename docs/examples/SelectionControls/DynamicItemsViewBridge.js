window.rhubarb.vb.create('DynamicItemsViewBridge',function(){
    return {
        attachEvents: function(){
            this.findChildViewBridge("Cuisine").attachClientEventHandler("ValueChanged", function(dropdown, value){
                this.findChildViewBridge("Menu").fetchAvailableSelectionItems(value);
            }.bind(this));
        }
    }
});