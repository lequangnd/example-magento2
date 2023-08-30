<?php

namespace Dtn\Office\Block\Department;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;

class Create extends Template
{
    /**
     * Create constructor.
     * @param Template\Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        protected Registry $registry,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }
}
