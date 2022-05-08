<?php

namespace Payir\SDK\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Payir\SDK\Exceptions\GetWalletException;
use Payir\SDK\Exceptions\GetWalletsListException;
use Payir\SDK\DTO\Wallet\WalletDTO;
use Payir\SDK\DTO\Wallet\WalletsDTO;

class Wallet extends AbstractAPIService
{
    /**
     * @return WalletsDTO
     * @throws GetWalletsListException
     * @throws GuzzleException
     */
    public function getList(): WalletsDTO
    {
        $res = $this->client->get($this->baseUri . "/wallets", [
            "headers" => [
                "Authorization" => "Bearer $this->token"
            ],
            RequestOptions::HTTP_ERRORS => false
        ]);

        if ($res->getStatusCode() == 200) {
            return WalletsDTO::fromArray(json_decode($res->getBody(), true)["data"]["wallets"]);
        }

        throw new GetWalletsListException($res->getBody());
    }

    /**
     * @param $id
     * @return WalletDTO
     * @throws GetWalletException
     * @throws GuzzleException
     */
    public function get($id): WalletDTO
    {
        $res = $this->client->get($this->baseUri . "/wallets/$id", [
            "headers" => [
                "Authorization" => "Bearer $this->token"
            ],
            RequestOptions::HTTP_ERRORS => false
        ]);

        if ($res->getStatusCode() == 200) {
            return WalletDTO::fromArray(json_decode($res->getBody(), true)["data"]["wallet"]);
        }

        throw new GetWalletException($res->getBody());
    }
}
