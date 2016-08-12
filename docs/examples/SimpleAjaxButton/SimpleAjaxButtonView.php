<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SimpleAjaxButton;

use Rhubarb\Leaf\Controls\Common\Buttons\Button;
use Rhubarb\Leaf\Views\View;

class SimpleAjaxButtonView extends View
{
    /** @var SimpleAjaxButtonModel $model */
    protected $model;

    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            $simpleAjaxButton = new Button("SimpleAjaxButton", "Click Me I am Ajax Enabled", function () {
                return 'You just clicked the amazing Simple Ajax Button';
            }, true)
        );
    }

    protected function printViewContent()
    {
        parent::printViewContent();

        print '<span id="simple-ajax-button-span">This text should change when you click the Ajax Button below</span>';

        print $this->leaves["SimpleAjaxButton"];
    }

    protected function getViewBridgeName()
    {
        return "SimpleAjaxButtonViewBridge";
    }

    public function getDeploymentPackage()
    {
        $package = parent::getDeploymentPackage();

        $package->resourcesToDeploy[] = __DIR__ . "/" . $this->getViewBridgeName() . ".js";

        return $package;
    }
}
