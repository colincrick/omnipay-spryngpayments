<?php

namespace Omnipay\SpryngPayments\Message\Request;

use Omnipay\Common\Message\ResponseInterface;
use Omnipay\SpryngPayments\Message\Response\FetchTransactionResponse;

class FetchTransactionRequest extends AbstractSpryngPaymentsRequest
{

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('apiKey', 'transactionReference');

        $data = [];
        $data['id'] = $this->getTransactionReference();

        return $data;
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return FetchTransactionResponse
     */
    public function sendData($data)
    {
        $response = $this->sendRequest(self::GET, '/transaction/'.$data['id']);

        return $this->response = new FetchTransactionResponse($this, $response);
    }
}