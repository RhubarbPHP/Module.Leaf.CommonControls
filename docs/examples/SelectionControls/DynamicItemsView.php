<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SelectionControls;

use Rhubarb\Leaf\Controls\Common\SelectionControls\DropDown\DropDown;
use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;
use Rhubarb\Leaf\Views\View;

class DynamicItemsView extends View
{
    protected function createSubLeaves()
    {
        $this->registerSubLeaf(
            $cuisine = new DropDown("Cuisine"),
            $menu = new MenuDropDown("Menu")
        );

        $cuisine->setSelectionItems(
            [
                ["", "Choose a cuisine"],
                "French",
                "Italian",
                "English"
            ]
        );
    }

    protected function printViewContent()
    {
        print $this->leaves["Cuisine"].$this->leaves["Menu"];
    }

    protected function getViewBridgeName()
    {
        return "DynamicItemsViewBridge";
    }

    public function getDeploymentPackage()
    {
        $package = parent::getDeploymentPackage();
        $package->resourcesToDeploy[] = __DIR__."/DynamicItemsViewBridge.js";

        return $package;
    }
}