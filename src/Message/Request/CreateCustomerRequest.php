<?php

namespace Omnipay\SpryngPayments\Message\Request;

use Omnipay\Common\Message\ResponseInterface;
use Omnipay\SpryngPayments\Message\Response\FetchCustomerResponse;

class CreateCustomerRequest extends AbstractSpryngPaymentsRequest
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
            'firstName',
            'lastName'
        );

        $data = [
            'first_name'    => $this->getParameter('firstName'),
            'last_name'     => $this->getParameter('lastName')
        ];
        $data = $this->setIfExists('city', 'city', $data);
        $data = $this->setIfExists('companyName', 'company_name', $data);
        $data = $this->setIfExists('companyRegistrationNumber', 'company_registration_number', $data);
        $data = $this->setIfExists('countryCode', 'country_code', $data);
        $data = $this->setIfExists('dateOfBirth', 'date_of_birth', $data);
        $data = $this->setIfExists('emailAddress', 'email_address', $data);
        $data = $this->setIfExists('gender', 'gender', $data);
        $data = $this->setIfExists('organisation', 'organisation', $data);
        $data = $this->setIfExists('phoneNumber', 'phone_number', $data);
        $data = $this->setIfExists('postalCode', 'postal_code', $data);
        $data = $this->setIfExists('region', 'region', $data);
        $data = $this->setIfExists('socialSecurityNumber', 'social_security_number', $data);
        $data = $this->setIfExists('streetAddress', 'street_address', $data);
        $data = $this->setIfExists('title', 'title', $data);

        return $data;
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
            self::POST,
            '/customer',
            $data
        );

        return $this->response = new FetchCustomerResponse($this, $response);
    }

    private function setIfExists($parameterKey, $requestKey, $data)
    {
        if (!is_null($value = $this->getParameter($parameterKey))) {
            $data[$requestKey] = $value;
        }

        return $data;
    }
}