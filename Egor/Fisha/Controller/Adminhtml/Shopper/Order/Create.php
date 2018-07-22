<?php
namespace Egor\Fisha\Controller\Adminhtml\Synchronize;



use Egor\Fisha\Api\Data\FishaOrderInterface;
use Egor\Fisha\Api\FishaOrderManagementInterface;
use Magento\Sales\Api\OrderRepositoryInterface;

class Create extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var \Egor\Fisha\Helper\Data
     */
    private $helper;
    /**
     * @var \Egor\Fisha\Api\FishaOrderManagementInterfaceFactory
     */
    private $fishaOrderManagementFactory;
    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;
    /**
     * @var \Egor\Fisha\Api\Data\FishaOrderInterfaceFactory
     */
    private $fishaOrderFactory;
    /**
     * @var \Egor\Fisha\Model\Mapper
     */
    private $mapper;

    /**
     * Create constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $collectionFactory
     * @param \Egor\Fisha\Helper\Data $helper
     * @param OrderRepositoryInterface $orderRepository
     * @param \Egor\Fisha\Api\FishaOrderManagementInterfaceFactory $fishaOrderManagementFactory
     * @param \Egor\Fisha\Api\Data\FishaOrderInterfaceFactory $fishaOrderFactory
     * @param \Egor\Fisha\Model\Mapper $mapper
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $collectionFactory,
        \Egor\Fisha\Helper\Data $helper,
        OrderRepositoryInterface $orderRepository,
        \Egor\Fisha\Api\FishaOrderManagementInterfaceFactory $fishaOrderManagementFactory,
        \Egor\Fisha\Api\Data\FishaOrderInterfaceFactory $fishaOrderFactory,
        \Egor\Fisha\Model\Mapper $mapper
    ) {
        parent::__construct($context);
        $this->collectionFactory = $collectionFactory;
        $this->helper = $helper;
        $this->fishaOrderManagementFactory = $fishaOrderManagementFactory;
        $this->orderRepository = $orderRepository;
        $this->fishaOrderFactory = $fishaOrderFactory;
        $this->mapper = $mapper;
    }

    /**
     * Create New Fisha Order action
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('order_id');
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('sales/order/view', ['order_id' => $id]);

        if (!$this->helper->isActive()) {
            $this->messageManager->addWarningMessage(__('Enable Fisha API and try again.'));
            return $resultRedirect;
        }

        try {
            $order = $this->orderRepository->get($id);

            $customerCollection = $this->collectionFactory->create();

            $customerCollection->addFieldToFilter('entity_id', $order->getCustomerId())
                ->addAttributeToSelect('fisha_shopper_id');

            $customer = $customerCollection->getFirstItem();

            if (!$customer->getFishaShopperId()) {
                $this->messageManager->addWarningMessage(__('The Customer is not a Fisha Shopper'));
                return $resultRedirect;
            }
            /**
             * @var $fishaOrder FishaOrderInterface
             */
            $fishaOrder = $this->fishaOrderFactory->create();
            $fishaOrder->setFishaShopperId($customer->getFishaShopperId());

            $this->mapper->orderToFishaOrder($fishaOrder, $order);

            /**
             * @var FishaOrderManagementInterface $fishaOrderManagement
             */
            $fishaOrderManagement = $this->fishaOrderManagementFactory->create();
            $fishaOrderId = $fishaOrderManagement->createNewOrder($fishaOrder);
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            return $resultRedirect;
        }

        $this->messageManager->addSuccessMessage(sprintf(__('Order was created successful. Fisha order id %s'), $fishaOrderId));
        return $resultRedirect;
    }
}
