<?php

namespace Omnipay\SpryngPayments\Message\Request;

use Omnipay\Common\Message\ResponseInterface;
use Omnipay\SpryngPayments\Message\Response\ListCustomerResponse;

class ListCustomerRequest extends AbstractSpryngPaymentsRequest
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
        $this->validate(
            'apiKey',
            'organisation',
            'emailAddress'
        );

        $data = [
            'organisation'  => $this->getParameter('organisation'),
            'email_address' => $this->getParameter('emailAddress')
        ];

        return $data;
    }

    public function setEmailAddress($value)
    {
        return $this->setParameter('emailAddress', $value);
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $response = $this->sendRequest(
            self::GET,
            '/customer?organisation='.$data['organisation'].'&email_address='.$data['email_address']
        );

        return $this->response = new ListCustomerResponse($this, $response);
    }
}