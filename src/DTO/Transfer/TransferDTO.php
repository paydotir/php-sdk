<?php

namespace Payir\SDK\DTO\Transfer;

use Payir\SDK\DTO\DTOInterface;

class TransferDTO implements DTOInterface
{
    /**
     * @var
     */
    public $transactionId;

    /**
     * @var
     */
    public $amount;

    /**
     * @param array $body
     * @return TransferDTO
     */
    public static function fromArray(array $body): TransferDTO
    {
        $dto = new self();
        $dto->transactionId = $body["transactionId"];
        $dto->amount = $body["amount"];

        return $dto;
    }
}
