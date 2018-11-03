<?php

namespace Omnipay\SpryngPayments\Test\Message;

use Omnipay\SpryngPayments\Message\Request\FetchTransactionRequest;
use Omnipay\Tests\TestCase;

class FetchTransactionRequestTest extends TestCase
{
    use AssertsRequests;

    protected $request;

    public function setUp()
    {
        $this->request = new FetchTransactionRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'apiKey'                => 'abc123',
            'transactionReference'  => 'abc123'
        ]);
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame('abc123', $data['id']);
    }
}