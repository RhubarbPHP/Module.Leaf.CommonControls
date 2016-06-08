var bridge = function( presenterPath )
{
	window.rhubarb.viewBridgeClasses.ViewBridge.apply( this, arguments );
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.setValue = function( value )
{
	if( typeof value == "string" || value instanceof String )
	{
		var dateTime = this.parseIsoDatetime( value );
		var hours = dateTime.getHours();
		var minutes = dateTime.getMinutes();

		this.findChildViewBridge( "hours" ).setValue( hours.pad() );
		this.findChildViewBridge( "minutes" ).setValue( minutes.pad() );
	}
	else if( typeof value == "object" && value instanceof Date )
	{
		this.findChildViewBridge( "hours" ).setValue( value.getHours() );
		this.findChildViewBridge( "minutes" ).setValue( value.getMinutes().pad() );
	}
};

bridge.prototype.parseIsoDatetime = function( date )
{
	var newDate = date.split( /[: T-]/ ).map( parseFloat );
	return new Date( newDate[0], newDate[1] - 1, newDate[2], newDate[3] || 0, newDate[4] || 0, newDate[5] || 0, 0 );
};

Number.prototype.pad = function( size )
{
	var value = String( this );

	if( value >= 10 )
	{
		return value;
	}

	while( value.length < (size || 2) )
	{
		value = "0" + value;
	}

	return value;
};

bridge.prototype.hasValue = function()
{
	return true;
};

bridge.prototype.getValue = function()
{
	var hours = this.findChildViewBridge( "hours" ).getValue();
	var minutes = this.findChildViewBridge( "minutes" ).getValue();

	return new Date( 2000, 1, 1, hours, minutes, 0 );
};

window.rhubarb.viewBridgeClasses.TimeViewBridge = bridge;