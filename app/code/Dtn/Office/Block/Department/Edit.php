<?php

namespace Dtn\Office\Block\Department;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;

class Edit extends Template
{
    public function __construct
    (
        Template\Context $context,
        protected Registry $registry,
        array $data = []
    )
    {
        parent::__construct($context, $data);
    }

    public function getDepartment()
    {
        return $this->registry->registry('current_department');
    }
}
