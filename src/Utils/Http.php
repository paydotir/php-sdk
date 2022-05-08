<?php

namespace Payir\SDK\Utils;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;

class Http
{
    /**
     * @var Client
     */
    private static $client;

    /**
     * @return Client
     */
    public static function getClient(): Client
    {
        if (!isset(self::$client)) {
            self::$client = new Client();
        }

        return self::$client;
    }

    /**
     * @param HandlerStack $handler
     * @return void
     */
    public static function fake(HandlerStack $handler): void
    {
        self::$client = new Client([
            "handler" => $handler
        ]);
    }
}
