<?php
namespace Egor\Fisha\Block\Adminhtml\Customer\Edit;


use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Customer\Block\Adminhtml\Edit\GenericButton;

class ShopperButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @var \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * ShopperButton constructor.
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $collectionFactory
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $collectionFactory
    ) {
        parent::__construct($context, $registry);
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return array
     */
    public function getButtonData()
    {
        $customer = $this->getCustomer();
        $data = [];
        if ($customer->getId()) {
            $data = [
                'label' => $customer->getFishaShopperId() ? __('Update shopper') :__('Create shopper'),
                'class' => 'shopper',
                'on_click' => sprintf("location.href = '%s';", $this->getShopperButtonUrl()),
                'sort_order' => 10,
            ];
        }
        return $data;
    }

    /**
     * @return string
     */
    public function getShopperButtonUrl()
    {
        return $this->getUrl('fisha/shopper/index', ['customer_id' => $this->getCustomerId()]);
    }

    /**
     * @return \Magento\Framework\DataObject
     */
    protected function getCustomer()
    {
        $customerId = $this->getCustomerId();
        $customerCollection = $this->collectionFactory->create();

        $customerCollection->addAttributeToFilter('entity_id', $customerId)
            ->addAttributeToSelect('fisha_shopper_id');

        return $customerCollection->getFirstItem();
    }
}
