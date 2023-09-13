<?php

namespace Dtn\ProductIngredient\Model\Ingredient\Attribute\Source;

use Dtn\ProductIngredient\Model\IngredientFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Cache\Type\Config;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Framework\Data\OptionSourceInterface;

class IngredientMultiOption extends AbstractSource implements OptionSourceInterface
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
     * @var IngredientFactory
     */
    protected $ingredientFactory;

    private $serializer;

    /**
     * IngredientMultiOption constructor.
     * @param IngredientFactory $ingredientFactory
     * @param StoreManagerInterface $storeManager
     * @param Config $configCacheType
     */
    public function __construct(
        IngredientFactory $ingredientFactory,
        StoreManagerInterface $storeManager,
        Config $configCacheType
    ) {
        $this->ingredientFactory = $ingredientFactory;
        $this->storeManager = $storeManager;
        $this->_configCacheType = $configCacheType;
    }

    /**
     * @return array|bool|float|int|string
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getAllOptions()
    {
        $cacheKey = 'PRODUCTINGREDIENT_SELECT_STORE_' . $this->storeManager->getStore()->getCode();
        if ($cache = $this->_configCacheType->load($cacheKey)) {
            $options = $this->getSerializer()->unserialize($cache);
        } else {
            $ingredient = $this->ingredientFactory->create();
            $collection = $ingredient->getResourceCollection();

            $options = [];
            foreach ($collection as $item) {
                $options[] = [
                    'value' => $item->getData('ingredient_id'),
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
