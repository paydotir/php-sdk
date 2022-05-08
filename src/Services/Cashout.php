<?php

namespace Payir\SDK\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Payir\SDK\DTO\Cashout\CashoutDTO;
use Payir\SDK\DTO\Cashout\CashoutsDTO;
use Payir\SDK\DTO\Cashout\IbanInquiryDTO;
use Payir\SDK\Exceptions\CreateCashoutException;
use Payir\SDK\Exceptions\DeleteCashoutException;
use Payir\SDK\Exceptions\GetCashoutException;
use Payir\SDK\Exceptions\GetCashoutsListException;
use Payir\SDK\Exceptions\IbanInquiryException;
use Payir\SDK\Exceptions\TrackCashoutException;

class Cashout extends AbstractAPIService
{
    /**
     * @param $walletId
     * @param $amount
     * @param $name
     * @param $iban
     * @param $uid
     * @param null $institutionId
     * @param null $paymentId
     * @return CashoutDTO
     * @throws GuzzleException
     * @throws CreateCashoutException
     */
    public function create($walletId, $amount, $name, $iban, $uid, $institutionId = null, $paymentId = null): CashoutDTO
    {
        $res = $this->client->post($this->baseUri . "/cashouts", [
            "headers" => [
                "Authorization" => "Bearer $this->token"
            ],
            "form_params" => [
                "walletId" => $walletId,
                "amount" => $amount,
                "name" => $name,
                "iban" => $iban,
                "uid" => $uid,
                "institutionId" => $institutionId,
                "paymentId" => $paymentId,
            ],
            RequestOptions::HTTP_ERRORS => false
        ]);

        if ($res->getStatusCode() == 200) {
            return CashoutDTO::fromArray(json_decode($res->getBody(), true)["data"]["cashout"]);
        }

        throw new CreateCashoutException($res->getBody());
    }

    /**
     * @param $id
     * @return bool
     * @throws DeleteCashoutException
     * @throws GuzzleException
     */
    public function delete($id): bool
    {
        $res = $this->client->delete($this->baseUri . "/cashouts/$id", [
            "headers" => [
                "Authorization" => "Bearer $this->token"
            ],
            RequestOptions::HTTP_ERRORS => false
        ]);

        if ($res->getStatusCode() == 200) {
            return true;
        }

        throw new DeleteCashoutException($res->getBody());
    }

    /**
     * @return CashoutsDTO
     * @throws GetCashoutsListException
     * @throws GuzzleException
     */
    public function getList(): CashoutsDTO
    {
        $res = $this->client->get($this->baseUri . "/cashouts", [
            "headers" => [
                "Authorization" => "Bearer $this->token"
            ],
            RequestOptions::HTTP_ERRORS => false
        ]);

        if ($res->getStatusCode() == 200) {
            return CashoutsDTO::fromArray(json_decode($res->getBody(), true)["data"]["cashouts"]);
        }

        throw new GetCashoutsListException($res->getBody());
    }

    /**
     * @param $id
     * @return CashoutDTO
     * @throws GetCashoutException
     * @throws GuzzleException
     */
    public function get($id): CashoutDTO
    {
        $res = $this->client->get($this->baseUri . "/cashouts/$id", [
            "headers" => [
                "Authorization" => "Bearer $this->token"
            ],
            RequestOptions::HTTP_ERRORS => false
        ]);

        if ($res->getStatusCode() == 200) {
            return CashoutDTO::fromArray(json_decode($res->getBody(), true)["data"]["cashout"]);
        }

        throw new GetCashoutException($res->getBody());
    }

    /**
     * @param string $uid
     * @return false|CashoutDTO
     * @throws GuzzleException
     * @throws TrackCashoutException
     */
    public function track(string $uid)
    {
        $res = $this->client->get($this->baseUri . "/cashouts/track/$uid", [
            "headers" => [
                "Authorization" => "Bearer $this->token"
            ],
            RequestOptions::HTTP_ERRORS => false
        ]);

        if ($res->getStatusCode() == 200) {
            return CashoutDTO::fromArray(json_decode($res->getBody(), true)["data"]["cashout"]);
        }

        if ($res->getStatusCode() == 422) {
            return false;
        }

        throw new TrackCashoutException($res->getBody());
    }

    /**
     * @param string $iban
     * @return IbanInquiryDTO
     * @throws GuzzleException
     * @throws IbanInquiryException
     */
    public function ibanInquiry(string $iban): IbanInquiryDTO
    {
        $res = $this->client->get($this->baseUri . "/cashouts/inquiry/$iban", [
            "headers" => [
                "Authorization" => "Bearer $this->token"
            ],
            RequestOptions::HTTP_ERRORS => false
        ]);

        if ($res->getStatusCode() == 200) {
            return IbanInquiryDTO::fromArray(json_decode($res->getBody(), true)["data"]["iban"]);
        }

        throw new IbanInquiryException($res->getBody());
    }
}
