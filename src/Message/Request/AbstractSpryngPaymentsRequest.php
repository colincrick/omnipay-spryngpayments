<?php

namespace Omnipay\SpryngPayments\Message\Request;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Http\ClientInterface;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\SpryngPayments\Methods\Bancontact;
use Omnipay\SpryngPayments\Methods\CreditCard;
use Omnipay\SpryngPayments\Methods\Giropay;
use Omnipay\SpryngPayments\Methods\iDEAL;
use Omnipay\SpryngPayments\Methods\Klarna;
use Omnipay\SpryngPayments\Methods\Paypal;
use Omnipay\SpryngPayments\Methods\SEPA;
use Omnipay\SpryngPayments\Methods\SOFORT;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

abstract class AbstractSpryngPaymentsRequest extends AbstractRequest
{
    const POST  = 'POST';
    const GET   = 'GET';

    protected $apiVersion = 'v1';

    /**
     * Live API base url.
     *
     * This base url will be used when the test mode is disabled.
     *
     * @var string
     */
    protected $liveBaseUrl = 'https://api.spryngpayments.com/';

    /**
     * Test API base url.
     *
     * This base url will be used when the test mode is enabled.
     *
     * @var string
     */
    protected $testBaseUrl = 'https://sandbox.spryngpayments.com/';

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

    public function getCapture()
    {
        return $this->getParameter('capture');
    }

    public function setCapture($capture)
    {
        return $this->setParameter('capture', $capture);
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

    public function getGoodsList()
    {
        return $this->getParameter('goodsList');
    }

    /**
     * @param array $goodsList
     */
    public function setGoodsList($goodsList)
    {
        $this->setParameter('goodsList', $goodsList);
    }

    public function getProjectId()
    {
        return $this->getParameter('projectId');
    }

    public function setProjectId($projectId)
    {
        $this->setParameter('projectId', $projectId);
    }

    public function getBic()
    {
        return $this->getParameter('bic');
    }

    public function setBic($bic)
    {
        return $this->setParameter('bic', $bic);
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
            'capture'               => $this->getCapture(),
            'customer_ip'           => $this->getCustomerIp(),
            'dynamic_descriptor'    => $this->getDynamicDescriptor(),
            'merchant_reference'    => $this->getMerchantReference(),
            'user_agent'            => $this->getUserAgent()
        ];
    }

    /**
     * Get the API base url.
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->getTestMode() ? $this->testBaseUrl : $this->liveBaseUrl;
    }

    protected function sendRequest($method, $endpoint, array $data = null)
    {
        $response = $this->httpClient->request(
            $method,
            $this->getBaseUrl() . $this->apiVersion . $endpoint,
            [
                'X-APIKEY' => $this->getApiKey()
            ],
            ($data === null) ? null : json_encode($data)
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
            case 'bancontact':
                return new Bancontact();
                break;
            case 'card':
                return new CreditCard();
                break;
            case 'giropay':
                return new Giropay();
                break;
            case 'ideal':
                return new iDEAL();
                break;
            case 'klarna':
                return new Klarna();
                break;
            case 'paypal':
                return new Paypal();
                break;
            case 'sepa':
                return new SEPA();
                break;
            case 'sofort':
                return new SOFORT();
                break;
            default:
                throw new InvalidRequestException($this->getParameter('payment_product'.' is not supported.'));
        }
    }
}