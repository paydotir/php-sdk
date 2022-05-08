<?php

namespace Payir\SDK\Tests;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Payir\SDK\Services\Gateway;
use Payir\SDK\Utils\Http;

class GatewayTest extends TestCase
{
    /**
     * @return void
     * @throws GuzzleException
     * @throws \Payir\SDK\Exceptions\GatewaySendException
     */
    public function testSend()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                "status" => "ok",
                "token" => "test-token"
            ]))
        ]);
        $mockHandler = HandlerStack::create($mock);
        Http::fake($mockHandler);

        $gateway = new Gateway("test");
        $send = $gateway->send("1000", "https://test.com/callback");
        $this->assertEquals("test-token", $send->token);
    }

    /**
     * @return void
     * @throws GuzzleException
     * @throws \Payir\SDK\Exceptions\GatewayVerifyException
     */
    public function testVerify()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                "status" => 1,
                "amount" => "1000",
                "transId" => "123",
                "factorNumber" => "123",
                "mobile" => "123",
                "description" => "description",
                "cardNumber" => "123",
                "message" => "OK",
            ]))
        ]);
        $mockHandler = HandlerStack::create($mock);
        Http::fake($mockHandler);

        $gateway = new Gateway("test");
        $verify = $gateway->verify("token");
        $this->assertEquals("1000", $verify->amount);
        $this->assertEquals("123", $verify->transId);
        $this->assertEquals("123", $verify->factorNumber);
    }
}
