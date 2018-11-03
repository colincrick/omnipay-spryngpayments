<?php

namespace Omnipay\SpryngPayments\Message\Response;

class FetchCustomerResponse extends AbstractSpryngPaymentsResponse
{
    public function getCustomerReference()
    {
        if (isset($this->data['_id'])) {
            return $this->data['_id'];
        }

        return null;
    }
}