<?php

namespace Omnipay\SpryngPayments\Message\Response;

class ListCustomerResponse extends AbstractSpryngPaymentsResponse
{
    public function getCustomer()
    {
        return $this->data[0] ?? null;
    }
}