<?php
/**
 * Created by PhpStorm.
 * User: egor
 * Date: 21.07.18
 * Time: 16:40
 */

namespace Egor\Fisha\Block\Adminhtml\Customer\Edit\Tab;


use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Customer\Controller\RegistryConstants;

class Shopper extends \Magento\Backend\Block\Widget\Form\Generic implements TabInterface
{
    /**
     * @var \Magento\Customer\Model\CustomerFactory
     */
    protected $customerCollectionFactory;

    /**
     * @var null|boolean
     */
    private $_isShopper = null;
    private $_customer;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context , $registry , $formFactory , $data);
        $this->customerCollectionFactory = $customerCollectionFactory;
    }

    /**
     * Return Tab label
     *
     * @return string
     * @api
     */
    public function getTabLabel()
    {
        return __('Fisha shopper');
    }

    /**
     * Return Tab title
     *
     * @return string
     * @api
     */
    public function getTabTitle()
    {
        return __('Fisha shopper');
    }

    /**
     * Can show tab in tabs
     *
     * @return boolean
     * @api
     */
    public function canShowTab()
    {
        return $this->_isShopper();
    }

    /**
     * Tab is hidden
     *
     * @return boolean
     * @api
     */
    public function isHidden()
    {
        return $this->_isShopper();
    }

    /**
     * @return string|null
     */
    public function getCustomerId()
    {
        return $this->_coreRegistry->registry(RegistryConstants::CURRENT_CUSTOMER_ID);
    }

    /**
     * @return bool|null
     */
    protected function _isShopper()
    {
        if ($this->_isShopper === null) {
            $this->_isShopper = false;

            $customerCollection = $this->customerCollectionFactory->create();

            $customerCollection->addAttributeToFilter('entity_id', $this->getCustomerId())
                ->addAttributeToSelect('fisha_shopper_id');

            $customer = $this->_getCustomer();

            if($customer->getId() && $customer->getFishaShopperId()){
                $this->_isShopper = true;
            }
        }

        return $this->_isShopper;
    }

    protected function _getCustomer()
    {
        if (!$this->_customer) {

            $customerCollection = $this->customerCollectionFactory->create();

            $customerCollection->addAttributeToFilter('entity_id', $this->getCustomerId())
                ->addAttributeToSelect('fisha_shopper_id');

            $this->_customer = $customerCollection->getFirstItem();
        }

        return $this->_customer;
    }


    /**
     * @return bool
     */
    public function isAjaxLoaded()
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function initForm()
    {
        /**@var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('fisha_shopper_');

        $fieldSet = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('Fisha shopper')]
        );

        $fieldSet->addField(
            'fisha_shopper_id',
            'text',
            [
                'name' => 'Fisha Shopper Id',
                'data-form-part' => $this->getData('target_form'),
                'label' => __('Fisha Shopper Id'),
                'title' => __('Fisha Shopper Id'),
                'value' => $this->_getCustomer()->getFishaShopperId(),
                'disabled' => true
            ]
        );

        $form->setUseContainer(true);

        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * @return string
     */
    protected function _toHtml()
    {
        if ($this->canShowTab()) {
            $this->initForm();
            return parent::_toHtml();
        } else {
            return '';
        }
    }

    /**
     * @return string
     */
    public function getFormHtml()
    {
        $html = parent::getFormHtml();
        $html .= $this->getChildHtml();
        return $html;
    }
}
