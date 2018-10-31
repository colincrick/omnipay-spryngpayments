<?php

namespace Omnipay\SpryngPayments\Message\Response;

use Omnipay\Common\Message\AbstractRequest\FetchTransactionResponse;

class PurchaseResponse extends FetchTransactionResponse
{
    public function isSuccessful()
    {
        return parent::isSuccessful();
    }
}