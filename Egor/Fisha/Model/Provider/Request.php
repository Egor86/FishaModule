<?php
namespace Egor\Fisha\Model\Provider;


use Magento\Framework\HTTP\ZendClient;
use Zend\Serializer\Serializer;

class Request extends ZendClient
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * Request constructor.
     */
    public function __construct(
        \Magento\Framework\Serialize\Serializer\Json $serializer,
        string $url
    ) {
        $this->serializer = $serializer;
        parent::__construct($url);
    }

    /**
     * Send request to Monitor Saas server.
     *
     * @param $data
     * @return \Zend_Http_Response
     */
    public function send($method, $data)
    {
        $this->setRawData($data);
        $this->setHeaders('Content-Type', 'application/json');
        return $this->request($method);
    }

    /**
     * @param resource|string|array $data
     * @param null $enctype
     * @return \Zend_Http_Client
     */
    public function setRawData($data, $enctype = null)
    {
        $data = $this->serializer->serialize($data);
        return parent::setRawData($data, $enctype);
    }
}
