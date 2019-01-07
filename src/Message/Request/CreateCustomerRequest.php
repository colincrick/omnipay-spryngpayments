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
            'organisation',
            'firstName',
            'lastName',
            'emailAddress',
            'streetAddress',
            'postalCode',
            'city',
            'countryCode'
        );

        $data = [
            'first_name'     => $this->getParameter('firstName'),
            'last_name'      => $this->getParameter('lastName'),
            'email_address'  => $this->getParameter('emailAddress'),
            'street_address' => $this->getParameter('streetAddress'),
            'postal_code'    => $this->getParameter('postalCode'),
            'city'           => $this->getParameter('city'),
            'country_code'   => $this->getParameter('countryCode'),
        ];
        $data = $this->setIfExists('companyName', 'company_name', $data);
        $data = $this->setIfExists('companyRegistrationNumber', 'company_registration_number', $data);
        $data = $this->setIfExists('dateOfBirth', 'date_of_birth', $data);
        $data = $this->setIfExists('gender', 'gender', $data);
        $data = $this->setIfExists('phoneNumber', 'phone_number', $data);
        $data = $this->setIfExists('region', 'region', $data);
        $data = $this->setIfExists('socialSecurityNumber', 'social_security_number', $data);
        $data = $this->setIfExists('title', 'title', $data);

        return $data;
    }

    public function setFirstName($value)
    {
        return $this->setParameter('firstName', $value);
    }

    public function setLastName($value)
    {
        return $this->setParameter('lastName', $value);
    }

    public function setEmailAddress($value)
    {
        return $this->setParameter('emailAddress', $value);
    }

    public function setStreetAddress($value)
    {
        return $this->setParameter('streetAddress', $value);
    }

    public function setPostalCode($value)
    {
        return $this->setParameter('postalCode', $value);
    }

    public function setCity($value)
    {
        return $this->setParameter('city', $value);
    }

    public function setCountryCode($value)
    {
        return $this->setParameter('countryCode', $value);
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