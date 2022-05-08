<?php

namespace Payir\SDK\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Payir\SDK\Exceptions\GatewaySendException;
use Payir\SDK\Exceptions\GatewayVerifyException;
use Payir\SDK\DTO\Gateway\SendDTO;
use Payir\SDK\DTO\Gateway\VerifyDTO;
use Payir\SDK\Utils\Http;

abstract class AbstractGateway
{
    /**
     * @var string
     */
    protected $baseUri = "https://pay.ir/pg";

    /**
     * @var bool
     */
    protected $share;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @param string $apiKey
     * @param bool $share
     */
    public function __construct(string $apiKey, bool $share = false)
    {
        $this->apiKey = $apiKey;
        $this->share = $share;
        $this->client = Http::getClient();
    }

    /**
     * @param int|string $amount
     * @param string $redirect
     * @param array $additional
     * @return SendDTO
     * @throws GuzzleException|GatewaySendException
     */
    public function send($amount, string $redirect, array $additional = []): SendDTO
    {
        $url = $this->share ? "/share/send" : "/send";
        $res = $this->client->post($this->baseUri . $url, [
            "form_params" => array_merge([
                "api" => $this->apiKey,
                "amount" => $amount,
                "redirect" => $redirect,
                "resellerId" => "1000000012"
            ], $additional),
            RequestOptions::HTTP_ERRORS => false
        ]);

        if ($res->getStatusCode() == 200) {
            return SendDTO::fromArray(json_decode($res->getBody(), true));
        }

        throw new GatewaySendException($res->getBody());
    }

    /**
     * @param string $token
     * @return VerifyDTO
     * @throws GatewayVerifyException
     * @throws GuzzleException
     */
    public function verify(string $token): VerifyDTO
    {
        $res = $this->client->post($this->baseUri . "/verify", [
            "form_params" => [
                "api" => $this->apiKey,
                "token" => $token
            ],
            RequestOptions::HTTP_ERRORS => false
        ]);

        if ($res->getStatusCode() == 200) {
            return VerifyDTO::fromArray(json_decode($res->getBody(), true));
        }

        throw new GatewayVerifyException($res->getBody());
    }
}
