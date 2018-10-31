<?php

namespace Omnipay\SpryngPayments\Test\Message;

use Omnipay\SpryngPayments\Message\Request\PurchaseRequest;
use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    protected $request;

    public function setUp()
    {
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'apiKey'                => 'abc123',
            'payment_product'       => 'ideal',
            'account'               => 'abc123',
            'amount'                => 1000,
            'customer_ip'           => '127.0.0.1',
            'dynamic_descriptor'    => 'TEST123',
            'merchant_reference'    => 'ORDER1',
            'issuer'                => 'Money Bank',
            'user_agent'            => 'Chrome',
            'redirect_url'          => 'https://example.com/return'
        ]);
    }

    public function testGetData()
    {
        $this->request->initialize([
            'apiKey'                => 'abc123',
            'paymentMethod'         => 'ideal',
            'account'               => 'abc123',
            'amount'                => 1000,
            'customerIp'            => '127.0.0.1',
            'dynamicDescriptor'     => 'TEST123',
            'merchantReference'     => 'ORDER1',
            'issuer'                => 'Money Bank',
            'userAgent'             => 'Chrome',
            'returnUrl'             => 'https://example.com/return'
        ]);

        $data = $this->request->getData();

        $this->assertSame('abc123', $data['account']);
        $this->assertSame(1000, $data['amount']);
        $this->assertSame('127.0.0.1', $data['customer_ip']);
        $this->assertSame('TEST123', $data['dynamic_descriptor']);
        $this->assertSame('ORDER1', $data['merchant_reference']);
        $this->assertSame('Chrome', $data['user_agent']);
        $this->assertSame(['issuer' => 'Money Bank', 'redirect_url' => 'https://example.com/return'], $data['details']);
    }
}