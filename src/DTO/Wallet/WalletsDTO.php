<?php

namespace Payir\SDK\DTO\Wallet;

use Payir\SDK\DTO\DTOInterface;

class WalletsDTO implements DTOInterface
{
    /**
     * @var WalletDTO[]
     */
    public $wallets;

    /**
     * @param array $body
     * @return WalletsDTO
     */
    public static function fromArray(array $body): WalletsDTO
    {
        $dto = new self();
        foreach ($body as $wallet) {
            $dto->wallets[] = WalletDTO::fromArray($wallet);
        }

        return $dto;
    }
}
