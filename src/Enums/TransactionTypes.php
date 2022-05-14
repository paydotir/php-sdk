<?php

namespace Payir\SDK\Enums;

class TransactionTypes
{
    const DEPOSIT = "1";

    const TRANSFER = "2";

    const CASHOUT = "3";

    const GATEWAY = "4";

    const SMS_DEPOSIT = "6";

    const REFUND = "7";

    const OFFLINE_DEPOSIT = "10";

    const CREATE_WALLET = "12";

    const PERSONAL_PAYMENT = "13";

    /**
     * not supported anymore
     * @deprecated
     */
    const EZ_FORM = "15";
}
