<?php

namespace Payir\SDK\DTO\Transaction;

use Payir\SDK\DTO\DTOInterface;

class TransactionsDTO implements DTOInterface
{
    /**
     * @var TransactionDTO[]
     */
    public $transactions;

    /**
     * @param array $body
     * @return TransactionsDTO
     */
    public static function fromArray(array $body): TransactionsDTO
    {
        $dto = new self();
        foreach ($body as $transaction) {
            $dto->transactions[] = TransactionDTO::fromArray($transaction);
        }

        return $dto;
    }
}
