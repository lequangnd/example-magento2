<?php

namespace Dtn\Office\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class RadioOption implements ArrayInterface
{

    public function toOptionArray()
    {
        return [
            ['value' => '1', 'label' => 'Nam Dinh'],
            ['value' => '2', 'label' => 'Ha Noi']
        ];
    }
}
