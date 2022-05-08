<?php

namespace Payir\SDK\DTO\Cashout;

use Payir\SDK\DTO\DTOInterface;

class IbanInquiryDTO implements DTOInterface
{
    /**
     * @var
     */
    public $name;

    /**
     * @var
     */
    public $bank;

    /**
     * @var
     */
    public $acc;

    /**
     * @var
     */
    public $comment;

    /**
     * @param array $body
     * @return IbanInquiryDTO
     */
    public static function fromArray(array $body): IbanInquiryDTO
    {
        $dto = new self();
        $dto->name = $body["name"];
        $dto->bank = $body["bank"];
        $dto->acc = $body["acc"];
        $dto->comment = $body["comment"];

        return $dto;
    }
}
