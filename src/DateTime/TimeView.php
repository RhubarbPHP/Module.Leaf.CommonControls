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

use Rhubarb\Leaf\Controls\Common\SelectionControls\DropDown\DropDown;
use Rhubarb\Leaf\Leaves\Controls\ControlView;
use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;

class TimeView extends ControlView
{
	protected $requiresContainerDiv = true;
	
	/**
	 * @var TimeModel
	 */
	protected $model;

	public function createSubLeaves()
	{
		$this->registerSubLeaf(
			$hours = new DropDown("hours"),
			$minutes = new DropDown("minutes")
		);
	}

	protected function beforeRender()
	{
		$hourRange = range( $this->model->hourStart, $this->model->hourEnd );
		$minuteRange = range( 0, 59, $this->model->minuteInterval );

		$pad = function ( &$value )
		{
			if( $value < 10 )
			{
				$value = "0" . $value;
			}
		};

		array_walk( $hourRange, $pad );
		array_walk( $minuteRange, $pad );

		$this->leaves[ "hours" ]->setSelectionItems( $hourRange );
		$this->leaves[ "minutes" ]->setSelectionItems( $minuteRange );
	}

	public function printViewContent()
	{
		print $this->leaves[ "hours" ] . " " . $this->leaves[ "minutes" ];
	}

	protected function getViewBridgeName()
	{
		return "TimeViewBridge";
	}

	public function getDeploymentPackage()
	{
		return new LeafDeploymentPackage(__DIR__ . "/TimeViewBridge.js");
	}
}