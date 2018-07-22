<?php
namespace Egor\Fisha\Api;


interface FishaProviderInterface
{
    /**
     * @param string $methodName
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function call(string $methodName, array $data);
}