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
```php
$gateway = new \Payir\SDK\Services\Gateway('API-KEY');
$send = $gateway->send(10000, "https://callback-url", [
    // additional data goes here
]);
$paymentUrl = "https://pay.ir/pg/$send->token";
```

### Verify

```php
$gateway = new \Payir\SDK\Services\Gateway('API-KEY');
$verify = $gateway->verify("token");
$paymentData = [
    "amount" => $verify->amount
    "transId" => $verify->transId
    "factorNumber" => $verify->factorNumber
    "mobile" => $verify->mobile
    "description" => $verify->description
    "cardNumber" => $verify->cardNumber
    "message" => $verify->message
];
```
