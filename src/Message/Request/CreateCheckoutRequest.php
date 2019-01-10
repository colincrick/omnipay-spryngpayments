<?php

namespace Omnipay\SpryngPayments\Message\Request;

use Omnipay\Common\Message\ResponseInterface;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\SpryngPayments\Message\Response\CreateCheckoutResponse;

class CreateCheckoutRequest extends AbstractSpryngPaymentsRequest
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
        $this->validate(
            'paymentMethod',
            'amount',
            'customerReference',
            'merchantReference',
            'dynamicDescriptor',
            'templateUrl',
            'returnUrl'
        );

        $data = [
            'account'            => $this->getParameter('account'),
            'amount'             => $this->getParameter('amount'),
            'customer'           => $this->getParameter('customerReference'),
            'merchant_reference' => $this->getParameter('merchantReference'),
            'template_url'       => $this->getParameter('templateUrl'),
            'return_url'         => $this->getParameter('returnUrl'),
        ];

        $data = $this->setIfExists('cssFramework', 'css_framework', $data);

        switch ($this->getParameter('paymentMethod')) {
            case 'card':
                $data['configurations']['card'] = [
                    'capture_now'        => $this->getParameter('capture'),
                    'dynamic_descriptor' => $this->getParameter('dynamicDescriptor'),
                    'threed_secure'      => [
                        'enabled' => false,
                    ]
                ];
                break;
            case 'bancontact':
                $data['configurations']['bancontact'] = [
                    'dynamic_descriptor' => $this->getParameter('dynamicDescriptor'),
                ];
            break;
        }

        if (!is_null($webhook = $this->getNotifyUrl())) {
            $data['webhook_transaction_update'] = $webhook;
        }

        return $data;
    }

    public function setTemplateUrl($value)
    {
        return $this->setParameter('templateUrl', $value);
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
        $response = $this->sendRequest(self::POST, '/checkout', $data);

        return $this->response = new CreateCheckoutResponse($this, $response);
    }
}