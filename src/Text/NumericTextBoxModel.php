<?php
/**
 * Copyright (c) 2016 RhubarbPHP.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Rhubarb\Leaf\Controls\Common\Text;

class NumericTextBoxModel extends TextBoxModel
{
    public $inputType = 'tel';

    /**
     * The number of decimal places to display
     * @var int
     */
    public $decimalPlaces = 2;

    public function setValue($value)
    {
        $value = preg_replace("/[^0-9\\.]/", "", $value);

        parent::setValue($value);
    }
}
