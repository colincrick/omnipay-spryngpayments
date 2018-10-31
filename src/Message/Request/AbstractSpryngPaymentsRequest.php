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

    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    public function setApiKey($apiKey)
    {
        $this->setParameter('apiKey', $apiKey);
    }

    public function getAccount()
    {
        return $this->getParameter('account');
    }

    public function setAccount($account)
    {
        $this->setParameter('account', $account);
    }

    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    public function setAmount($amount)
    {
        $this->setParameter('amount', $amount);
    }

    public function getCustomerIp()
    {
        return $this->getParameter('customerIp');
    }

    public function setCustomerIp($customerIp)
    {
        return $this->setParameter('customerIp', $customerIp);
    }

    public function getDynamicDescriptor()
    {
        return $this->getParameter('dynamicDescriptor');
    }

    public function setDynamicDescriptor($dd)
    {
        $this->setParameter('dynamicDescriptor', $dd);
    }

    public function getMerchantReference()
    {
        return $this->getParameter('merchantReference');
    }

    public function setMerchantReference($mr)
    {
        $this->setParameter('merchantReference', $mr);
    }

    public function getUserAgent()
    {
        return $this->getParameter('userAgent');
    }

    public function setUserAgent($ua)
    {
        $this->setParameter('userAgent', $ua);
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
        switch ($this->getPaymentMethod())
        {
            case 'ideal':
                return new iDEAL();
                break;
            default:
                throw new InvalidRequestException($this->getParameter('payment_product'.' is not supported.'));
        }
    }
}