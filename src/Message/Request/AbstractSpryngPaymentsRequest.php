<?php

namespace Omnipay\SpryngPayments\Message\Request;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\SpryngPayments\Methods\iDEAL;

abstract class AbstractSpryngPaymentsRequest extends AbstractRequest
{
    const POST  = 'POST';
    const GET   = 'GET';

    protected $apiVersion = 'v1';

    protected $baseUrl = 'https://api.spryngpayments.com/';

    public function getAccount()
    {
        return $this->getParameter('account');
    }

    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    public function getCustomerIp()
    {
        return $this->getParameter('customer_ip');
    }

    public function getDynamicDescriptor()
    {
        return $this->getParameter('dynamic_descriptor');
    }

    public function getMerchantReference()
    {
        return $this->getParameter('merchant_reference');
    }

    public function getUserAgent()
    {
        return $this->getParameter('user_agent');
    }

    public function getBaseTransactionData()
    {
        return [
            'account'               => $this->getAccount(),
            'amount'                => $this->getAmount(),
            'customer_ip'           => $this->getCustomerIp(),
            'dynamic_descriptor'    => $this->getDynamicDescriptor(),
            'merchant_reference'    => $this->getMerchantReference(),
            'user_agent'            => $this->getUserAgent()
        ];
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

    /**
     * @return \Omnipay\SpryngPayments\PaymentMethod
     * @throws InvalidRequestException
     */
    protected function getMethodClassForPaymentProduct()
    {
        switch ($this->getParameter('payment_product'))
        {
            case 'ideal':
                return new iDEAL();
                break;
            default:
                throw new InvalidRequestException($this->getParameter('payment_product'.' is not supported.'));
        }
    }
}