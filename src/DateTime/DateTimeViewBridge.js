var bridge = function (leafPath) {
  window.rhubarb.viewBridgeClasses.DateViewBridge.apply(this, arguments)
}

bridge.prototype = new window.rhubarb.viewBridgeClasses.DateViewBridge()
bridge.prototype.constructor = bridge

bridge.prototype.attachEvents = function () {
  this.enabledCheckbox = document.getElementById(this.leafPath + '_enabled')
  this.yearDropDown = document.getElementById(this.leafPath + '_year')
  this.monthDropDown = document.getElementById(this.leafPath + '_month')
  this.dayDropDown = document.getElementById(this.leafPath + '_day')
  this.hourDropDown = document.getElementById(this.leafPath + '_hour')
  this.minuteDropDown = document.getElementById(this.leafPath + '_minute')

  if (this.enabledCheckbox) {
    this.enabledCheckbox.onclick = function () {
      this.yearDropDown.disabled = !this.enabledCheckbox.checked
      this.monthDropDown.disabled = !this.enabledCheckbox.checked
      this.dayDropDown.disabled = !this.enabledCheckbox.checked
      this.hourDropDown.disabled = !this.enabledCheckbox.checked
      this.minuteDropDown.disabled = !this.enabledCheckbox.checked
    }.bind(this)
  }
}

bridge.prototype.setValue = function (value) {
  window.rhubarb.viewBridgeClasses.DateViewBridge.prototype.setValue.call(this, value)
  var date = new Date(value)

  this.hourDropDown.value = date.getHours()
  this.minuteDropDown.value = date.getMinutes()
}

bridge.prototype.getValue = function () {
  if (!this.isEnabled()) {
    return null
  }

  return new Date(
    this.yearDropDown.value,
    this.monthDropDown.value - 1,
    this.dayDropDown.value,
    this.hourDropDown.value,
    this.minuteDropDown.value,
    0,
    0
  )
}

window.rhubarb.viewBridgeClasses.DateTimeViewBridge = bridge
