<?php

namespace Dtn\Office\Block\Department;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;

class Edit extends Template
{
    /**
     * Edit constructor.
     * @param Template\Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct (
        Template\Context $context,
        protected Registry $registry,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Get department data from registry
     *
     * @return mixed|null
     */
    public function getDepartment()
    {
        return $this->registry->registry('current_department');
    }
}
