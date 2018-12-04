<?php

namespace Omnipay\SpryngPayments\Message\Response;

use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Class FetchTransactionResponse
 * @package Omnipay\Common\Message\AbstractRequest
 */
class FetchTransactionResponse extends AbstractSpryngPaymentsResponse implements RedirectResponseInterface
{
    /**
     * @return string
     */
    public function getRedirectMethod()
    {
        return 'GET';
    }

    /**
     * @return bool
     */
    public function isRedirect()
    {
        return isset($this->data['details']['approval_url']);
    }

    /**
     * @return string
     */
    public function getRedirectUrl()
    {
        return $this->data['details']['approval_url'];
    }

    /**
     * @return null|string
     */
    public function getTransactionReference()
    {
        if (isset($this->data['_id'])) {
            return $this->data['_id'];
        }

        return null;
    }

    /**
     * @return null
     */
    public function getStatus()
    {
        if (isset($this->data['status'])) {
            return $this->data['status'];
        }

        return null;
    }

    /**
     * @return null
     */
    public function getMerchantReference()
    {
        return $this->data['merchant_reference'] ?? null;
    }
}