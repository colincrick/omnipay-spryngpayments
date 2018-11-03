<?php

namespace Omnipay\SpryngPayments\Message\Request;

use Omnipay\Common\Message\ResponseInterface;
use Omnipay\SpryngPayments\Message\Response\RefundTransactionResponse;

class RefundTransactionRequest extends AbstractSpryngPaymentsRequest
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
        $this->validate('paymentMethod');
        $method = $this->getMethodClassForPaymentProduct();
        $this->validate($method->requiredRefundParameters());

        $data = $method->setRefundData([], $this->getParameters());

        return $data;
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function sendData($data)
    {
        $method = $this->getMethodClassForPaymentProduct();
        $response = $this->sendRequest(
            self::POST,
            $method->getRefundUrl($this->getTransactionReference()),
            $data
        );

        return $this->response = new RefundTransactionResponse($this, $response);
    }
}