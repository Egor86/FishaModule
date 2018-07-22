<?php
namespace Egor\Fisha\Helper;


use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    const PATH_ACTIVE = 'egor_fisha/information/active';
    const PATH_API_KEY = 'egor_fisha/information/api_key';

    /**
     * Retrieve company id from config
     *
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->scopeConfig->getValue(self::PATH_API_KEY);
    }

    /**
     * Check if module is activated in configuration
     *
     * @return bool
     */
    public function isActive()
    {
        return (bool) $this->scopeConfig->getValue(self::PATH_ACTIVE);
    }
}
