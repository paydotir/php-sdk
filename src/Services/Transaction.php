<?php

namespace Payir\SDK\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Payir\SDK\Exceptions\GetTransactionsListException;
use Payir\SDK\DTO\Transaction\TransactionsDTO;

class Transaction extends AbstractAPIService
{
    /**
     * @param array $filter
     * @return TransactionsDTO
     * @throws GetTransactionsListException
     * @throws GuzzleException
     */
    public function getList(array $filter = []): TransactionsDTO
    {
        $res = $this->client->get($this->baseUri . "/transactions?" . http_build_query($filter), [
            "headers" => [
                "Authorization" => "Bearer $this->token"
            ],
            RequestOptions::HTTP_ERRORS => false
        ]);

        if ($res->getStatusCode() == 200) {
            return TransactionsDTO::fromArray(json_decode($res->getBody(), true)["data"]["transactions"]);
        }

        throw new GetTransactionsListException($res->getBody());
    }
}
