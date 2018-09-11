<?php

namespace Omnipay\SpryngPayments\Message\Request;

use Omnipay\Common\Message\AbstractRequest;

abstract class AbstractSpryngPaymentsRequest extends AbstractRequest
{
    const POST  = 'POST';
    const GET   = 'GET';

    protected $apiVersion = 'v1';

    protected $baseUrl = 'https://api.spryngpayments.com/';

    public function getApiKey()
    {
        return $this->getParameter('apikey');
    }

    protected function sendRequest($method, $endpoint, array $data = null)
    {
        $response = $this->httpClient->request(
            $method,
            $this->baseUrl . $this->apiVersion . $endpoint,
            [
                'X-APIKEY' => $this->getApiKey()
            ],
            json_encode($data)
        );

        return json_decode($response->getBody(), true);
    }
}