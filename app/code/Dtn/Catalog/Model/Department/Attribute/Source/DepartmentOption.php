<?php

namespace Dtn\Catalog\Model\Department\Attribute\Source;

use Dtn\Office\Model\DepartmentFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Cache\Type\Config;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Framework\Data\OptionSourceInterface;

class DepartmentOption extends AbstractSource implements OptionSourceInterface
{
    /**
     * @var Config
     */
    protected $_configCacheType;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var DepartmentFactory
     */
    protected $departmentFactory;

    /**
     * @var \Magento\Framework\Serialize\SerializerInterface
     */
    private $serializer;

    public function __construct(
        DepartmentFactory $countryFactory,
        StoreManagerInterface $storeManager,
        Config $configCacheType
    ) {
        $this->departmentFactory = $countryFactory;
        $this->storeManager = $storeManager;
        $this->_configCacheType = $configCacheType;
    }

    public function getAllOptions()
    {
        $cacheKey = 'DTNDEPARTMENT_SELECT_STORE_' . $this->storeManager->getStore()->getCode();
        if ($cache = $this->_configCacheType->load($cacheKey)) {
            $options = $this->getSerializer()->unserialize($cache);
        } else {
            $department = $this->departmentFactory->create();
            $collection = $department->getResourceCollection();

            foreach ($collection as $item) {
                $options[] = [
                    'value' => $item->getData('department_id'),
                    'label' => $item->getData('name'),
                ];
            }
            $this->_configCacheType->save($this->getSerializer()->serialize($options), $cacheKey);
        }
        return $options;
    }

    /**
     * Get serializer
     *
     * @return \Magento\Framework\Serialize\SerializerInterface
     * @deprecated 102.0.0
     */
    private function getSerializer()
    {
        if ($this->serializer === null) {
            $this->serializer = \Magento\Framework\App\ObjectManager::getInstance()
                ->get(\Magento\Framework\Serialize\SerializerInterface::class);
        }
        return $this->serializer;
    }
}
