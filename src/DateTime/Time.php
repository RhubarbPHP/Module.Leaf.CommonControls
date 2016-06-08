<?php

/*
 *	Copyright 2015 RhubarbPHP
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */

namespace Rhubarb\Leaf\Controls\Common\DateTime;

use Rhubarb\Crown\DateTime\RhubarbTime;
use Rhubarb\Leaf\Leaves\Controls\CompositeControl;

class Time extends CompositeControl
{
	/**
	 * @var TimeModel
	 */
	protected $model;

	public function __construct( $name = "", $defaultValue = null, $minuteInterval = 1, $hourStart = 0, $hourEnd = 23 )
	{
		parent::__construct( $name );

		$this->model->minuteInterval = $minuteInterval;
		$this->model->hourStart = $hourStart;
		$this->model->hourEnd = $hourEnd;

		if( $defaultValue !== null && $this->model->hours == "" && $this->model->minutes == "" )
		{
			$this->model->hours = $defaultValue->format( "H" );
			$this->model->minutes = $defaultValue->format( "i" );
		}
	}

	protected function createModel()
	{
		return new TimeModel();
	}

	protected function getViewClass()
	{
		return TimeView::class;
	}

	/**
	 * The place to parse the value property and break into the sub values for sub controls to bind to
	 *
	 * @param $compositeValue
	 */
	protected function parseCompositeValue( $compositeValue )
	{
		$time = false;

		try
		{
			$time = new RhubarbTime( $compositeValue );
		}
		catch( \Exception $er )
		{
		}

		if( $time === false )
		{
			$this->model->hours = "";
			$this->model->minutes = "";
		}
		else
		{
			$this->model->hours = $time->format( "H" );
			$this->model->minutes = $time->format( "i" );
		}
	}

	/**
	 * The place to combine the model properties for sub values into a single value, array or object.
	 *
	 * @return mixed
	 */
	protected function createCompositeValue()
	{
		$hours = (int) $this->model->hours;
		$minutes = (int) $this->model->minutes;

		$time = new RhubarbTime();
		$time->setTime( $hours, $minutes );

		return $time;
	}
}