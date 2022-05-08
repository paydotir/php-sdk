<?php

namespace Payir\SDK\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\RequestOptions;
use Payir\SDK\DTO\Transfer\TransferDTO;

class Transfer extends AbstractAPIService
{
    /**
     * @param $fromWallet
     * @param $toWallet
     * @param $amount
     * @param $description
     * @param $ip
     * @return TransferDTO
     * @throws GuzzleException
     */
    public function self($fromWallet, $toWallet, $amount, $description, $ip): TransferDTO
    {
        $res = $this->client->post($this->baseUri . "/transfer/self", [
            "headers" => [
                "Authorization" => "Bearer $this->token"
            ],
            "form_params" => [
                "fromWallet" => $fromWallet,
                "toWallet" => $toWallet,
                "amount" => $amount,
                "description" => $description,
                "ip" => $ip
            ],
            RequestOptions::HTTP_ERRORS => false
        ]);

        if ($res->getStatusCode() == 200) {
            return TransferDTO::fromArray(json_decode($res->getBody(), true)["data"]["transfer"]);
        }

        throw new TransferException($res->getBody());
    }

    /**
     * @param $fromWallet
     * @param $mobile
     * @param $amount
     * @param $description
     * @param $ip
     * @return TransferDTO
     * @throws GuzzleException
     */
    public function other($fromWallet, $mobile, $amount, $description, $ip): TransferDTO
    {
        $res = $this->client->post($this->baseUri . "/transfer/other", [
            "headers" => [
                "Authorization" => "Bearer $this->token"
            ],
            "form_params" => [
                "fromWallet" => $fromWallet,
                "mobile" => $mobile,
                "amount" => $amount,
                "description" => $description,
                "ip" => $ip
            ],
            RequestOptions::HTTP_ERRORS => false
        ]);

        if ($res->getStatusCode() == 200) {
            return TransferDTO::fromArray(json_decode($res->getBody(), true)["data"]["transfer"]);
        }

        throw new TransferException($res->getBody());
    }
}
