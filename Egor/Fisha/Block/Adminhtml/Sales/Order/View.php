<?php

namespace Egor\Fisha\Block\Adminhtml\Sales\Order;


class View extends \Magento\Sales\Block\Adminhtml\Order\View
{
    protected function _construct()
    {
        parent::_construct();
        $currentOrder = $this->_coreRegistry->registry('current_order');

        if ($currentOrder && $currentOrder->getId()) {
            $this->addButton('fisha_order',[
                'label' => __('Create Fisha order'),
                'class' => 'create-fisha-order',
                'id' => 'order-view-create-fisha-order',
                'data_attribute' => [
                    'url' => $this->getUrl('fisha/shopper/order/create', ['order_id' => $currentOrder->getId()])
                ]
            ]);
        }
    }
}