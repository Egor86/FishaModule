<?php
namespace Egor\Fisha\Model;

use \Egor\Fisha\Model\Provider\Request;
use \Egor\Fisha\Api\FishaProviderInterface;
use Magento\Framework\Exception\AuthorizationException;
use Zend\Http\Response;

class FishaProvider implements FishaProviderInterface
{
    /**
     * @var \Egor\Fisha\Helper\Data
     */
    private $helper;

    /**
     * @var \Egor\Fisha\Logger\Logger
     */
    private $logger;

    /**
     * @var Provider\RequestFactory
     */
    private $requestFactory;

    /**
     * FishaProvider constructor.
     * @param \Egor\Fisha\Helper\Data $helper
     * @param \Egor\Fisha\Logger\Logger $logger
     * @param Provider\RequestFactory $requestFactory
     */
    public function __construct(
        \Egor\Fisha\Helper\Data $helper,
        \Egor\Fisha\Logger\Logger $logger,
        \Egor\Fisha\Model\Provider\RequestFactory $requestFactory
    ) {
        $this->logger = $logger;
        $this->helper = $helper;
        $this->requestFactory = $requestFactory;
    }

    /**
     * @param string $methodName
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function call(string $methodName, array $data)
    {
        if (!method_exists($this, $methodName) || $methodName == __METHOD__) {
            $this->logger->addWarning(sprintf(__('The method %s does exist.'), $methodName));
            throw new \Exception(sprintf(__('The method %s does exist.'), $methodName));
        }

        try {
            $auth = $this->requestFactory->create(['url' => 'http://fisha.api.co.il/auth']);
            $response = $auth->send(Request::POST, ['api_key' => $this->helper->getApiKey()]);

            if ($response->getStatus() != Response::STATUS_CODE_200) {
                throw new AuthorizationException(__($response->getMessage()));
            }

            $result = call_user_func([$this, $methodName], $data);

            if (is_array($result) && isset($result['error'])) {
                throw new \Exception($result['error']['errorMsg'] . '. Error code: ' . $result['error']['errorCode']);
            }
        } catch (\Exception $e) {
            $this->logger->addError(sprintf(__('There was an error while the method %s was proceed: %s'), $methodName, $e->getMessage()));
            throw $e;
        }

        $this->logger->addInfo(sprintf(__('The request %s was complete successful'), $methodName));

        return $result;
    }

    /**
     * @param array $data
     * @return \Zend_Http_Response
     */
    private function createNewShopper(array $data)
    {
        /**
         * @var $request Request
         */
        $request = $this->requestFactory->create(['url' => 'http://fisha.api.co.il/createNewShopper']);

        return $request->send(Request::POST, $data);
    }

    /**
     * @param array $data
     * @return \Zend_Http_Response
     */
    private function updateShopper(array $data)
    {
        /**
         * @var $request Request
         */
        $request = $this->requestFactory->create(['url' => 'http://fisha.api.co.il/updateShopper']);

        return $request->send(Request::PUT, $data);
    }

    /**
     * @param array $data
     * @return \Zend_Http_Response
     */
    private function getShopperById(array $data)
    {
        /**
         * @var $request Request
         */
        $request = $this->requestFactory->create(['url' => 'http://fisha.api.co.il/getShopperById']);

        return $request->send(Request::GET, $data);
    }

    /**
     * @param array $data
     * @return \Zend_Http_Response
     */
    private function createNewOrder(array $data)
    {
        /**
         * @var $request Request
         */
        $request = $this->requestFactory->create(['url' => 'http://fisha.api.co.il/createNewOrder']);

        return $request->send(Request::POST, $data);
    }

    /**
     * @param array $data
     * @return \Zend_Http_Response
     */
    private function getOrders(array $data)
    {
        /**
         * @var $request Request
         */
        $request = $this->requestFactory->create(['url' => 'http://fisha.api.co.il/getOrders']);

        return $request->send(Request::GET, $data);
    }
}
