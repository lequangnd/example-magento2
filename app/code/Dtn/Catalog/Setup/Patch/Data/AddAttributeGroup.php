<?php

namespace Dtn\Catalog\Setup\Patch\Data;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Eav\Setup\EavSetupFactory;

class AddAttributeGroup implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * AddAttributeGroup constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @return AddAttributeGroup|void
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Validator\ValidateException
     */
    public function apply()
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $eavSetup->addAttribute(
            Product::ENTITY,
            'dtn_text',
            [
                'type' => 'varchar',
                'label' => 'Dtn Text',
                'input' => 'text',
                'required' => false,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'group' => 'Custom',
            ]
        );

        $eavSetup->addAttribute(
            Product::ENTITY,
            'dtn_select',
            [
                'type' => 'int',
                'label' => 'Dtn Select',
                'input' => 'select',
                'source' => \Magento\Eav\Model\Entity\Attribute\Source\Table::class,
                'required' => false,
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'Custom',
            ]
        );

        $eavSetup->addAttributeOption([
            'attribute_id' => $eavSetup->getAttributeId(Product::ENTITY, 'dtn_select'),
            'value' => [
                'option1' => ['Option 1'],
                'option2' => ['Option 2'],
                'option3' => ['Option 3'],
                'option4' => ['Option 4'],
                'option5' => ['Option 5'],
            ],
        ]);
    }

    /**
     * @return array
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @return array
     */
    public function getAliases()
    {
        return [];
    }
}
