<?php

namespace Omnipay\SpryngPayments\Test\Message;

use Psr\Http\Message\RequestInterface;

trait AssertsRequests
{
    abstract function assertEquals($expected, $actual, $message = '', $delta = 0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false);

    abstract function assertJsonStringEqualsJsonString($expected, $actual, $message = null);

    abstract function assertArraySubset($subset, $array, $strict = false, $message = '');


    /**
     * Check if all elements contained in a JSON object exist in another JSON object by parsing
     * the JSON and checking the intersection of the resulting arrays. Used to see if the request
     * parameters are contained in a response which may hold more parameters.
     *
     * @param $expectedContains
     * @param $actual
     */
    public function assertJsonContainsJson($expectedContains, $actual)
    {
        $this->assertEquals(
            count(array_intersect(
                json_decode($expectedContains, true),
                json_decode($actual, true)
            )) === count($actual),
            true
        );
    }

    public function assertEqualRequest(RequestInterface $expectedRequest, RequestInterface $actualRequest)
    {
        $this->assertEquals($expectedRequest->getMethod(), $actualRequest->getMethod(), "Expected request Method should be equal to actual request method.");

        $this->assertEquals($expectedRequest->getUri(), $actualRequest->getUri(), "Expected request Uri should be equal to actual request body.");

        if(!empty((string) $expectedRequest->getBody())) {
            $this->assertArraySubset(json_decode($expectedRequest->getBody(), true), json_decode($actualRequest->getBody(), true));
        }
    }
}