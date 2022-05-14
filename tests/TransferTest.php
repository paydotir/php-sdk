<?php

namespace Payir\SDK\Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Payir\SDK\Services\Transfer;
use Payir\SDK\Utils\Http;

class TransferTest extends TestCase
{
    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testSelf()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                "success" => true,
                "data" => [
                    "transfer" => [
                        "transactionId" => 1,
                        "amount" => 100000,
                    ]
                ]
            ]))
        ]);
        $mockHandler = HandlerStack::create($mock);
        Http::fake($mockHandler);

        $transfer = new Transfer($this->token);
        $res = $transfer->self(1, 2, "100000", "description", "1.1.1.1");

        $this->assertEquals(1, $res->transactionId);
        $this->assertEquals(100000, $res->amount);
    }

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testOther()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                "success" => true,
                "data" => [
                    "transfer" => [
                        "transactionId" => 1,
                        "amount" => 100000,
                    ]
                ]
            ]))
        ]);
        $mockHandler = HandlerStack::create($mock);
        Http::fake($mockHandler);

        $transfer = new Transfer($this->token);
        $res = $transfer->other(1, "09123456789", "100000", "description", "1.1.1.1");

        $this->assertEquals(1, $res->transactionId);
        $this->assertEquals(100000, $res->amount);
    }
}
