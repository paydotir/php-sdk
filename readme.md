# Pay.ir PHP SDK

The Pay.ir SDK makes it easy for developers to access [Pay.ir's Services](https://docs.pay.ir)

## Installation

    composer require paydotir/php-sdk

## Services

- Gateway
- Wallet
- Cashout
- Transaction
- Transfer

## Gateway

### Send

    $gateway = new Payir\SDK\Services\Gateway('API-KEY');
    $send = $gateway->send(10000, "https://callback-url", [
        // additional data goes here
    ]);

### Verify

    $gateway = new Payir\SDK\Services\Gateway('API-KEY');
    $verify = $gateway->verify("token");
