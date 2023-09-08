<?php

namespace Dtn\Office\Model;

use Magento\Framework\Model\AbstractModel;
use Dtn\Office\Api\Data\DepartmentInterface;

class Department extends AbstractModel implements DepartmentInterface
{

    const NAME = 'name';

    protected function _construct()
    {
        $this->_init(\Dtn\Office\Model\ResourceModel\Department::class);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->_getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName($name)
    {
        $this->setData(self::NAME);
    }
}
