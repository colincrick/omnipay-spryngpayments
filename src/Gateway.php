<?php

namespace Omnipay\SpryngPayments;

use Omnipay\Common\AbstractGateway;
use Omnipay\SpryngPayments\Message\Request\CreateCheckoutRequest;
use Omnipay\SpryngPayments\Message\Request\CreateCustomerRequest;
use Omnipay\SpryngPayments\Message\Request\FetchTransactionRequest;
use Omnipay\SpryngPayments\Message\Request\ListCustomerRequest;
use Omnipay\SpryngPayments\Message\Request\PurchaseRequest;
use Omnipay\SpryngPayments\Message\Request\UpdateCustomerRequest;

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return "Spryng Payments";
    }

    public function getDefaultParameters()
    {
        return array(
            'apiKey'       => '',
            'organisation' => '',
            'account'      => '',
            'testMode'     => false,
        );
    }

    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    public function setApiKey($apiKey)
    {
        return $this->setParameter('apiKey', $apiKey);
    }

    public function setAccount($account)
    {
        return $this->setParameter('account', $account);
    }

    public function setOrganisation($organisation)
    {
        return $this->setParameter('organisation', $organisation);
    }

    public function getOrganisation()
    {
        return $this->getParameter('organisation');
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    /**
     * Fetch a transaction
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function fetchTransaction(array $parameters = array())
    {
        return $this->createRequest(FetchTransactionRequest::class, $parameters);
    }

    /**
     * Create a customer
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function createCustomer(array $parameters = array())
    {
        return $this->createRequest(CreateCustomerRequest::class, $parameters);
    }

    /**
     * Update a customer
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function updateCustomer(array $parameters = array())
    {
        return $this->createRequest(UpdateCustomerRequest::class, $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function listCustomer(array $parameters = array())
    {
        return $this->createRequest(ListCustomerRequest::class, $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function createCheckout(array $parameters = array())
    {
        return $this->createRequest(CreateCheckoutRequest::class, $parameters);
    }

    public function completePurchase(array $options = array())
    {
        // TODO: Implement completePurchase() method.
    }

    public function refund(array $options = array())
    {
        // TODO: Implement refund() method.
    }

    public function authorize(array $options = array())
    {
        // TODO: Implement authorize() method.
    }

    public function completeAuthorize(array $options = array())
    {
        // TODO: Implement completeAuthorize() method.
    }

    public function deleteCard(array $options = array())
    {
        // TODO: Implement deleteCard() method.
    }

    public function void(array $options = array())
    {
        // TODO: Implement void() method.
    }

    public function capture(array $options = array())
    {
        // TODO: Implement capture() method.
    }

    public function createCard(array $options = array())
    {
        // TODO: Implement createCard() method.
    }

    public function updateCard(array $options = array())
    {
        // TODO: Implement updateCard() method.
    }
}