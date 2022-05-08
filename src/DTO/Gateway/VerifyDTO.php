<?php

namespace Payir\SDK\DTO\Gateway;

use Payir\SDK\DTO\DTOInterface;

class VerifyDTO implements DTOInterface
{
    /**
     * @var string
     */
    public $amount;

    /**
     * @var string
     */
    public $transId;

    /**
     * @var string
     */
    public $factorNumber;

    /**
     * @var string
     */
    public $mobile;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $cardNumber;

    /**
     * @var string
     */
    public $message;

    /**
     * @param array $body
     * @return $this
     */
    public static function fromArray(array $body): self
    {
        $dto = new self();
        $dto->amount = $body['amount'];
        $dto->transId = $body['transId'];
        $dto->factorNumber = $body['factorNumber'];
        $dto->mobile = $body['mobile'];
        $dto->description = $body['description'];
        $dto->cardNumber = $body['cardNumber'];
        $dto->message = $body['message'];

        return $dto;
    }
}
