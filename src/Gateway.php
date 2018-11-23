<?php

namespace Omnipay\SpryngPayments;

use Omnipay\Common\AbstractGateway;
use Omnipay\SpryngPayments\Message\Request\PurchaseRequest;

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return "Spryng Payments";
    }

    public function getDefaultParameters()
    {
        return array(
            'apiKey'   => '',
            'testMode' => false
        );
    }

    public function getApiKey()
    {
        return $this->getParameter('apikey');
    }

    public function setApiKey($apiKey)
    {
        return $this->setParameter('apikey', $apiKey);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
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