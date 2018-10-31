<?php

namespace Omnipay\SpryngPayments\Message\Response;

use Omnipay\Common\Message\AbstractResponse;

class AbstractSpryngPaymentsResponse extends AbstractResponse
{

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        if (!in_array($this->data['status'], ['SETTLEMENT_COMPLETED', 'SETTLEMENT_REQUESTED'])) {
            return false;
        }

        return true;
    }

    public function isOpen()
    {
        if (in_array($this->data['status'], ['INITIATED', 'PENDING'])) {
            return true;
        }

        return false;
    }

    public function isPending()
    {
        return $this->data['status'] === 'PENDING';
    }

    public function isPaid()
    {
        return $this->isSuccessful();
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return json_encode($this->data);
    }
}