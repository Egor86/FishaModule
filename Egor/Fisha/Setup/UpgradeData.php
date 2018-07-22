<?php
namespace Egor\Fisha\Setup;


use Magento\Backend\Block\Dashboard;
use Magento\Customer\Model\Customer;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\App\Config\Storage\WriterInterface as ConfigWriter;
use Magento\Config\Model\Config\Backend\Admin\Custom as ConfigBackend;
use Magento\Framework\View\Asset\Config as AssetConfig;
use Magento\Store\Model\ScopeInterface;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var \Magento\Eav\Setup\EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * UpgradeData constructor.
     * @param \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.1') < 0) {
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
            $eavSetup->addAttribute(
                Customer::ENTITY,
                'fisha_shopper_id',
                [
                    'group' => 'Fisha Shopper data',
                    'type' => 'varchar',
                    'label' => 'Fisha Shopper id',
                    'input' => 'text',
                    'backend' => '',
                    'frontend' => '',
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                    'visible' => false,
                    'required' => false,
                    'user_defined' => false,
                    'unique' => false,
                    'adminhtml_only' => 1,
                    'system' => 0,
                    'is_used_in_grid' => true
                ]
            );
        }

        $setup->endSetup();
    }
}
