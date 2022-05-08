<?php

namespace Payir\SDK\DTO\Gateway;

use Payir\SDK\DTO\DTOInterface;

class SendDTO implements DTOInterface
{
    /**
     * @var string
     */
    public $token;

    /**
     * @param array $body
     * @return $this
     */
    public static function fromArray(array $body): self
    {
        $dto = new self();
        $dto->token = $body['token'];

        return $dto;
    }
}
