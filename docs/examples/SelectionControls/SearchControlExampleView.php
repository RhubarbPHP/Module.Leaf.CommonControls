<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SelectionControls;

use Rhubarb\Leaf\Views\View;

class SearchControlExampleView extends View
{
    protected function createSubLeaves()
    {
        $this->registerSubLeaf(
            $control = new ExampleSearchControl("control")
        );

        $control->setSelectionItems(
            [
                [ 99, "John Smith", ["FirstName" => "John", "Surname" => "Smith" ]],
                [ 98, "Jane Doe", ["FirstName" => "Jane", "Surname" => "Doe" ]],
                ExampleContact::all()->addSort("FirstName")
            ]
        );
    }

    protected function printViewContent()
    {
        print $this->leaves["control"];
    }

    public function getDeploymentPackage()
    {
        $package = parent::getDeploymentPackage();
        $package->resourcesToDeploy[] = __DIR__.'/search.css';

        return $package;
    }


}