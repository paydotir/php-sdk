<?php

namespace Payir\SDK\DTO\Transaction;

use Payir\SDK\DTO\DTOInterface;

class TransactionDTO implements DTOInterface
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $depositType;

    /**
     * @var string
     */
    public $depositAmount;

    /**
     * @var string
     */
    public $transactionAmount;

    /**
     * @var string
     */
    public $balance;

    /**
     * @var string
     */
    public $transactionType;

    /**
     * @var string
     */
    public $transactionTypeLabel;

    /**
     * @var string
     */
    public $ip;

    /**
     * @var string
     */
    public $country;

    /**
     * @var array
     */
    public $detail;

    /**
     * @var string
     */
    public $createdAt;

    /**
     * @var string
     */
    public $jalaliCreatedAt;

    /**
     * @param array $body
     * @return TransactionDTO
     */
    public static function fromArray(array $body): TransactionDTO
    {
        $dto = new self();
        $dto->id = $body["id"];
        $dto->depositType = $body["depositType"];
        $dto->depositAmount = $body["depositAmount"];
        $dto->transactionAmount = $body["transactionAmount"];
        $dto->balance = $body["balance"];
        $dto->transactionType = $body["transactionType"];
        $dto->transactionTypeLabel = $body["transactionTypeLabel"];
        $dto->ip = $body["ip"];
        $dto->country = $body["country"];
        $dto->detail = $body["detail"];
        $dto->createdAt = $body["createdAt"];
        $dto->jalaliCreatedAt = $body["jalaliCreatedAt"];

        return $dto;
    }
}
