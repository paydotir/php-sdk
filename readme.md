# Pay.ir PHP SDK

The Pay.ir SDK makes it easy for developers to access [Pay.ir's Services](https://docs.pay.ir)

## Installation

    composer require paydotir/php-sdk

## Services

- [Gateway](#gateway)
- [Wallet](#wallet)
- [Cashout](#cashout)
- [Transaction](#transaction)
- [Transfer](#transfer)

### Gateway

**Send**

For normal transaction

```php
$gateway = new \Payir\SDK\Services\Gateway('API-KEY');
$send = $gateway->send(10000, "https://callback-url", [
    // additional data goes here
]);
$paymentUrl = "https://pay.ir/pg/$send->token";
```

For shared transaction

```php
$gateway = new \Payir\SDK\Services\GatewayShare('API-KEY');
$send = $gateway->send(10000, "https://callback-url", [
    // additional data goes here
]);
$paymentUrl = "https://pay.ir/pg/$send->token";
```

**Verify**

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

### Wallet

**Wallets list**

```php
$api = new \Payir\SDK\Services\Wallet("API-TOKEN");
$walletsList = $api->getList(); // this will return an object of \Payir\SDK\DTO\Wallet\WalletsDTO::class
foreach ($walletsList->wallets as $wallet) {
    // $wallet is an instance of \Payir\SDK\DTO\Wallet\WalletDTO::class
}
```

**Get wallet by ID**

```php
$api = new \Payir\SDK\Services\Wallet("API-TOKEN");
$wallet = $api->get("wallet-id"); // this will return an object of \Payir\SDK\DTO\Wallet\WalletDTO::class
```

### Cashout

**Track cashout**

```php
$api = new \Payir\SDK\Services\Cashout("API-TOKEN");
$cashout = $api->track("uid"); // this will return an object of \Payir\SDK\DTO\Cashout\CashoutDTO::class or false
```

**Send cashout request**

```php
$api = new \Payir\SDK\Services\Cashout("API-TOKEN");
$cashout = $api->create(
    "wallet-id", 
    "amount-IRR", 
    "receiver-name", 
    "receiver-IBAN", 
    "uid" // a unique id from your application
); // this will return an object of \Payir\SDK\DTO\Cashout\CashoutDTO::class
```

**Get cashout by ID**

```php
$api = new \Payir\SDK\Services\Cashout("API-TOKEN");
$cashout = $api->get("cashout-id"); // this will return an object of \Payir\SDK\DTO\Cashout\CashoutDTO::class
```

**Track cashout**

```php
$api = new \Payir\SDK\Services\Cashout("API-TOKEN");
$cashoutsList = $api->getList(); // this will return an object of \Payir\SDK\DTO\Cashout\CashoutsDTO::class
foreach ($cashoutsList->cashouts as $cashout) {
    // $cashout is an instance of \Payir\SDK\DTO\Cashout\CashoutDTO::class
}
```

**Delete cashout**

```php
$api = new \Payir\SDK\Services\Cashout("API-TOKEN");
$delete = $api->delete("cashout-id"); // this will return true or false
```

**IBAN inquiry**

```php
$api = new \Payir\SDK\Services\Cashout("API-TOKEN");
$inquiry = $api->ibanInquiry("IBAN-NUMBER"); // this will return an object of \Payir\SDK\DTO\Cashout\IbanInquiryDTO::class
```

### Transaction

**Transactions list**

```php
$api = new \Payir\SDK\Services\Transaction("API-TOKEN");
$transactionsList = $api->getList([
    // [optional] supported filters here like below
    "fromDate" => "2022-02-02",
    "toDate" => "2022-03-02",
    "fromAmount" => "10000",
    "toAmount" => "20000",
    "transactionId" => "12345",
    "depositType" => 1, // 1 for Credit and -1 for Debit
    "transactionType" => \Payir\SDK\Enums\TransactionTypes::GATEWAY,
    "cardNumber" => "6219XXXXXXXXXXXX",
    "factorNumber" => "factor-number-in-your-app",
    "walletId" => "wallet-id",
    "sort" => \Payir\SDK\Enums\TransactionSort::ASC
]); // this will return an object of \Payir\SDK\DTO\Transaction\TransactionsDTO::class
foreach ($transactionsList->transactions as $transaction) {
    // $transaction is an instance of \Payir\SDK\DTO\Transaction\TransactionDTO::class
}
```


### Transfer

**Transfer to another wallet of yours**

```php
$api = new \Payir\SDK\Services\Transfer("API-TOKEN");
$transfer = $api->self(
    "from-wallet-id",
    "to-wallet-id",
    "amount",
    "description",
    "senders-ip-address" // you can pass your servers ip or your client's ip address
); // this will return an object of \Payir\SDK\DTO\Transfer\TransferDTO::class
```

**Transfer to others wallets**

```php
$api = new \Payir\SDK\Services\Transfer("API-TOKEN");
$transfer = $api->other(
    "from-wallet-id",
    "receivers-mobile-number",
    "amount",
    "description",
    "senders-ip-address" // you can pass your servers ip or your client's ip address
); // this will return an object of \Payir\SDK\DTO\Transfer\TransferDTO::class
```

## Security

If you discover any security issues please open an issue or contact us directly (info@pay.ir)

## License

This package has been developed under MIT license.
