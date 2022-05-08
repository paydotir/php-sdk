<?php

namespace Payir\SDK\DTO\Cashout;

use Payir\SDK\DTO\DTOInterface;

class CashoutsDTO implements DTOInterface
{
    /**
     * @var CashoutDTO[]
     */
    public $cashouts;

    /**
     * @param array $body
     * @return CashoutsDTO
     */
    public static function fromArray(array $body): CashoutsDTO
    {
        $dto = new self();
        foreach ($body as $cashout) {
            $dto->cashouts[] = CashoutDTO::fromArray($cashout);
        }

        return $dto;
    }
}
