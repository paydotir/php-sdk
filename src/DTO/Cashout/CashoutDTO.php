<?php

namespace Payir\SDK\DTO\Cashout;

use Payir\SDK\DTO\DTOInterface;

class CashoutDTO implements DTOInterface
{
    /**
     * @var
     */
    public $id;

    /**
     * @var
     */
    public $transactionId;

    /**
     * @var
     */
    public $amount;

    /**
     * @var
     */
    public $name;

    /**
     * @var
     */
    public $bankAccountNumber;

    /**
     * @var
     */
    public $bankIbanNumber;

    /**
     * @var
     */
    public $depositReferrerNumber;

    /**
     * @var
     */
    public $status;

    /**
     * @var
     */
    public $statusLabel;

    /**
     * @var
     */
    public $rejectReason;

    /**
     * @var
     */
    public $createdAt;

    /**
     * @var
     */
    public $jalaliCreatedAt;

    /**
     * @param array $body
     * @return CashoutDTO
     */
    public static function fromArray(array $body): CashoutDTO
    {
        $dto = new self();
        $dto->id = $body["id"];
        $dto->transactionId = $body["transactionId"];
        $dto->amount = $body["amount"];
        $dto->name = $body["name"];
        $dto->bankAccountNumber = $body["bankAccountNumber"];
        $dto->bankIbanNumber = $body["bankIbanNumber"];
        $dto->depositReferrerNumber = $body["depositReferrerNumber"];
        $dto->status = $body["status"];
        $dto->statusLabel = $body["statusLabel"];
        $dto->rejectReason = $body["rejectReason"];
        $dto->createdAt = $body["createdAt"];
        $dto->jalaliCreatedAt = $body["jalaliCreatedAt"];

        return $dto;
    }
}
