<?php
namespace Rhubarb\Leaf\Controls\Common\DateTime;

use Rhubarb\Leaf\Leaves\Controls\CompositeControlModel;

class TimeModel extends CompositeControlModel
{
	public $hours = 0;
	public $minutes = 0;
	
	public $minuteInterval = 0;
	public $hourStart = 0;
	public $hourEnd = 0;
}