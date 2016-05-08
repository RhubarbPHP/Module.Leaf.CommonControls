<?php

namespace Rhubarb\Leaf\Controls\Common\SelectionControls\CheckSetTable;

use Rhubarb\Leaf\Controls\Common\SelectionControls\SelectionControlView;

/**
 * Horizontally oriented checkboxes
 */
class CheckSetTableView extends SelectionControlView
{
    protected $requiresContainer = false;
    protected $requiresStateInputs = false;

    protected function printViewContent()
    {
        $name = $this->model->leafPath;
        $name = \htmlentities($name) . '[]';

        $presenterPath = \htmlentities($this->model->leafPath);
        $presenterName = \htmlentities($this->model->leafName);
        $attributes = $this->model->getHtmlAttributes();

        $checkRow = $headerRow = '';

        foreach ($this->model->selectionItems as $item) {
            if (isset($item->Children)) {
                $itemList = $item->Children;
                $text = \htmlentities($item->label);
                $headerRow .= '<th rowspan="2">' . $text . '</th>';
            } else {
                $itemList = [$item];
            }

            if (count($itemList)) {
                foreach ($itemList as $subItem) {
                    $value = \htmlentities($subItem->value);
                    $text = \htmlentities($subItem->label);
                    $checked = $this->isValueSelected($subItem->value) ? ' checked="checked"' : '';
                    $data = \htmlentities(json_encode($subItem));
                    $headerRow .= '<th>' . $text . '</th>';
                    $checkRow .= <<<HTML
                    <td>
                        <input type="checkbox" name="$name" value="$value"$checked data-item="$data" />
                    </td>
HTML;
                }
            }
        }

        print <<<HTML
		<table id="$presenterPath" presenter-name="$presenterName"$attributes>
			<thead><tr>$headerRow</tr></thead>
			<tbody><tr>$checkRow</tr></tbody>
		</table>
HTML;
    }
}
