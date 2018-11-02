<?php

namespace Omnipay\SpryngPayments\Message\Request;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\ResponseInterface;
use Omnipay\SpryngPayments\Message\Response\PurchaseResponse;

class PurchaseRequest extends AbstractSpryngPaymentsRequest
{

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     * @throws InvalidRequestException
     */
    public function getData()
    {
        // Initially validate payment_product to make sure it is set
        $this->validate(
            'paymentMethod'
        );

        // Get the method class for the payment product and call $this->validate for the required parameters
        $method = $this->getMethodClassForPaymentProduct();

        call_user_func_array([$this, 'validate'], $method::requiredPurchaseParameters());

        // Set required parameters
        $data = $this->getBaseTransactionData();
        $data = $method->setPurchaseData($data, $this->getParameters());
        $data['payment_product'] = $this->getPaymentMethod();

        if (!is_null($customer = $this->getParameter('customer'))) {
            $data['customer'] = $customer;
        }
        if (!is_null($webhook = $this->getNotifyUrl())) {
            $data['webhook_transaction_update'] = $webhook;
        }

        return $data;
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     * @throws InvalidRequestException
     */
    public function sendData($data)
    {
        $method = $this->getMethodClassForPaymentProduct();

        // Get the response from the initate url and return a PurchaseResponse
        $response = $this->sendRequest(self::POST, $method::getInitiateUrl(), $data);

        return $this->response = new PurchaseResponse($this, $response);
    }
}