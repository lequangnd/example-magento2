<?php

namespace Dtn\Office\Controller\Index;

use Dtn\Office\Model\Config\Source\SelectOption;
use Dtn\Office\Model\Config\Source\RadioOption;

class Config extends \Magento\Framework\App\Action\Action
{

    protected $helperData;
    protected $selectOption;
    protected $radioOption;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Dtn\Office\Helper\Data $helperData,
        SelectOption $selectOption,
        RadioOption $radioOption

    )
    {
        $this->helperData = $helperData;
        $this->selectOption = $selectOption;
        $this->radioOption = $radioOption;
        return parent::__construct($context);
    }

    public function execute()
    {
        if ($this->helperData->getGeneralConfig('enable') == 0) {
            echo "System configuration hidden";
        } else {
            echo "Name: " . $this->helperData->getGeneralConfig('name') . "<br>";
            echo "Telephone: " . $this->helperData->getGeneralConfig('phone') . "<br>";

            foreach ($this->selectOption->toOptionArray() as $arr) {
                if ($arr['value'] == $this->helperData->getGeneralConfig('department')) {
                    echo "Department: " . $arr['label']."<br>";
                }
            }

            foreach ($this->radioOption->toOptionArray() as $arr) {
                if ($arr['value'] == $this->helperData->getGeneralConfig('country')) {
                    echo "Country: " . $arr['label'];
                }
            }
        }
        exit();

    }
}
