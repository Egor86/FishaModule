<?php
namespace Egor\Fisha\Controller\Adminhtml\Shopper;


class Index extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var \Egor\Fisha\Helper\Data
     */
    private $helper;
    /**
     * @var \Egor\Fisha\Api\Data\ShopperInterfaceFactory
     */
    private $shopperFactory;
    /**
     * @var \Egor\Fisha\Api\ShopperAccountManagementInterfaceFactory
     */
    private $shopperAccountManagementFactory;
    /**
     * @var \Egor\Fisha\Model\Mapper
     */
    private $mapper;

    /**
     * Index constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $collectionFactory
     * @param \Egor\Fisha\Helper\Data $helper
     * @param \Egor\Fisha\Model\Mapper $mapper
     * @param \Egor\Fisha\Api\Data\ShopperInterfaceFactory $shopperFactory
     * @param \Egor\Fisha\Api\ShopperAccountManagementInterfaceFactory $shopperAccountManagementFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $collectionFactory,
        \Egor\Fisha\Helper\Data $helper,
        \Egor\Fisha\Model\Mapper $mapper,
        \Egor\Fisha\Api\Data\ShopperInterfaceFactory $shopperFactory,
        \Egor\Fisha\Api\ShopperAccountManagementInterfaceFactory $shopperAccountManagementFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->collectionFactory = $collectionFactory;
        $this->helper = $helper;
        $this->shopperFactory = $shopperFactory;
        $this->shopperAccountManagementFactory = $shopperAccountManagementFactory;
        $this->mapper = $mapper;
    }

    /**
     * Update or create Shopper Action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $customerId = (int)$this->getRequest()->getParam('customer_id');

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('customer/index/edit', ['id' => $customerId, '_current' => true]);

        if (!$this->helper->isActive()) {
            $this->messageManager->addWarningMessage(__('Enable Fisha API and try again.'));
            return $resultRedirect;
        }

        $customer = $this->getCustomer($customerId);
        if (!$customer->getId()) {
            $resultRedirect->setPath('customer/index/index');
            $this->messageManager->addWarningMessage(__('Requested customer is not exist.'));
            return $resultRedirect;
        }

        try {
            /**
             * @var $shopper \Egor\Fisha\Api\Data\ShopperInterface
             */
            $shopper = $this->shopperFactory->create();
            $this->mapper->customerToShopper($shopper, $customer);

            /**
             * @var $shopperAccountManagement \Egor\Fisha\Api\ShopperAccountManagementInterface
             */
            $shopperAccountManagement = $this->shopperAccountManagementFactory->create();
            if ($shopper->getFishaShopperId()) {
                $shopperAccountManagement->updateShopper($shopper);
                $this->messageManager->addSuccessMessage(__('The shopper was updated successful.'));
            } else {
                $fishaShopperId = 11;
                $this->messageManager->addSuccessMessage(__('The shopper was created successful.'));
                $customer->setFishaShopperId($fishaShopperId);
                $customer->getResource()->saveAttribute($customer, 'fisha_shopper_id');
            }
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while shpper was proceed.'));
        }

        return $resultRedirect;
    }

    /**
     * Get customer by id
     *
     * @param $customerId
     * @return \Magento\Framework\DataObject
     */
    protected function getCustomer($customerId)
    {
        $customerCollection = $this->collectionFactory->create();

        $customerCollection->addFieldToFilter('entity_id', $customerId)
            ->addAttributeToSelect('fisha_shopper_id');

        return $customerCollection->getFirstItem();
    }
}
