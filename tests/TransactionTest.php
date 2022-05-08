<?php

namespace Payir\SDK\Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Payir\SDK\Services\Transaction;
use Payir\SDK\Utils\Http;

class TransactionTest extends TestCase
{
    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Payir\SDK\Exceptions\GetTransactionsListException
     */
    public function testGetList()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                "success" => true,
                "data" => [
                    "transactions" => [
                        [
                            "id" => 1,
                            "depositType" => "1",
                            "depositAmount" => 100000,
                            "transactionAmount" => 100000,
                            "balance" => 100000,
                            "transactionType" => "1",
                            "transactionTypeLabel" => "نوع تراکنش",
                            "ip" => "-",
                            "country" => "-",
                            "detail" => [
                                "from" => [
                                    "walletId" => "",
                                    "name" => "",
                                    "cardNumber" => "",
                                    "mobile" => ""
                                ],
                                "to" => [
                                    "walletId" => "",
                                    "name" => "",
                                    "mobile" => "",
                                    "bankAccountNumber" => "",
                                    "bankSheba" => "",
                                    "formName" => "",
                                    "website" => "",
                                    "factorNumber" => ""
                                ],
                                "extra" => [
                                    "website" => "",
                                    "factorNumber" => "",
                                    "mobile" => "",
                                    "formName" => "",
                                    "name" => "",
                                    "email" => ""
                                ]
                            ],
                            "createdAt" => "2021-03-21 00:00:00",
                            "jalaliCreatedAt" => "1400-01-01 00:00:00"
                        ]
                    ]
                ]
            ]))
        ]);
        $mockHandler = HandlerStack::create($mock);
        Http::fake($mockHandler);

        $transaction = new Transaction("test");
        $res = $transaction->getList([
            "fromDate" => "2021-03-21",
            "toDate" => "1400-01-01"
        ]);

        $this->assertEquals(1, $res->transactions[0]->id);
    }
}
