<?php

namespace Omnipay\SpryngPayments\Test\Message;

use GuzzleHttp\Psr7\Request;
use Omnipay\SpryngPayments\Message\Request\PurchaseRequest;
use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    use AssertsRequests;

    protected $request;

    protected $defaultData = [
        'apiKey'                => 'abc123',
        'paymentMethod'         => 'ideal',
        'account'               => 'abc123',
        'capture'               => false,
        'amount'                => 1000,
        'customerIp'            => '127.0.0.1',
        'dynamicDescriptor'     => 'TEST123',
        'merchantReference'     => 'ORDER1',
        'issuer'                => 'Money Bank',
        'userAgent'             => 'Chrome',
        'returnUrl'             => 'https://example.com/return',
        'notifyUrl'             => 'https://example.com/notify'
    ];

    public function setUp()
    {
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize($this->defaultData);
    }

    public function testGetData()
    {
        $this->request->initialize($this->defaultData);

        $data = $this->request->getData();

        $this->assertSame($this->defaultData['account'], $data['account']);
        $this->assertSame($this->defaultData['amount'], $data['amount']);
        $this->assertSame($this->defaultData['customerIp'], $data['customer_ip']);
        $this->assertSame($this->defaultData['dynamicDescriptor'], $data['dynamic_descriptor']);
        $this->assertSame($this->defaultData['merchantReference'], $data['merchant_reference']);
        $this->assertSame($this->defaultData['userAgent'], $data['user_agent']);
        $this->assertSame(['redirect_url' => 'https://example.com/return', 'issuer' => 'Money Bank'], $data['details']);
        $this->assertSame($this->defaultData['notifyUrl'], $data['webhook_transaction_update']);
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('PurchaseRequestSuccess.txt');
        $response = $this->request->send();

        $this->assertEqualRequest(
            new Request(
                'POST',
                'https://api.spryngpayments.com/v1/transaction/ideal/initiate',
                [],
                '{
                        "account": "abc123",
                        "amount": 1000,
                        "capture": false,
                        "customer_ip": "127.0.0.1",
                        "dynamic_descriptor": "TEST123",
                        "merchant_reference": "ORDER1",
                        "user_agent": "Chrome",
                        "webhook_transaction_update": "https://example.com/notify",
                        "details": {
                          "redirect_url": "https://example.com/return",
                          "issuer": "Money Bank"
                        },
                        "payment_product":"ideal"
                       }'
            ),
            $this->getMockClient()->getLastRequest()
        );
    }
}