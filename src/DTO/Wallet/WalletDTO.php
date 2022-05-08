<?php

namespace Payir\SDK\DTO\Wallet;

use Payir\SDK\DTO\DTOInterface;

class WalletDTO implements DTOInterface
{
    /**
     * @var
     */
    public $id;

    /**
     * @var
     */
    public $name;

    /**
     * @var
     */
    public $balance;

    /**
     * @var
     */
    public $cashoutableAmount;

    /**
     * @param array $body
     * @return WalletDTO
     */
    public static function fromArray(array $body): WalletDTO
    {
        $dto = new self();
        $dto->id = $body["id"];
        $dto->name = $body["name"];
        $dto->balance = $body["balance"];
        $dto->cashoutableAmount = $body["cashoutableAmount"];

        return $dto;
    }
}
