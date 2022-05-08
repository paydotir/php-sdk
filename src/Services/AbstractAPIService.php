<?php

namespace Payir\SDK\Services;

use GuzzleHttp\Client;
use Payir\SDK\Utils\Http;

abstract class AbstractAPIService
{
    /**
     * @var string
     */
    protected $baseUri = "https://pay.ir/api/v2";

    /**
     * @var
     */
    protected $token;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
        $this->client = Http::getClient();
    }
}
