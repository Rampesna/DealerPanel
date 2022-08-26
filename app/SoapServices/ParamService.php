<?php

namespace App\SoapServices;

use SoapClient;

class ParamService
{
    /**
     * @var string $baseUrl
     */
    protected $baseUrl;

    /**
     * @var SoapClient $client
     */
    protected $client;

    /**
     * @var string $guid
     */
    protected $guid;

    /**
     * @var integer $clientCode
     */
    protected $clientCode;

    /**
     * @var string $clientUsername
     */
    protected $clientUsername;

    /**
     * @var string $clientPassword
     */
    protected $clientPassword;

    /**
     * @var string $successUrl
     */
    protected $successUrl;

    /**
     * @var string $failureUrl
     */
    protected $failureUrl;

    public function __construct()
    {
        $this->baseUrl = 'https://posws.param.com.tr/turkpos.ws/service_turkpos_prod.asmx?wsdl';
        $this->client = new SoapClient($this->baseUrl);
        $this->guid = 'F7F6DA0C-81DA-4EAB-AB7B-1745204D7A0D';
        $this->clientCode = 44506;
        $this->clientUsername = 'TP10076153';
        $this->clientPassword = '6AD169D581F57551';
        $this->successUrl = route('payment.success');
        $this->failureUrl = route('payment.failure');
    }

    /**
     * @param string $guid
     * @param integer $numberOfInstallment
     * @param string $transactionAmount
     * @param string $totalAmount
     * @param string $orderId
     */
    private function SHA2B64(
        $guid,
        $numberOfInstallment,
        $transactionAmount,
        $totalAmount,
        $orderId
    )
    {
        return $this->client->SHA2B64([
            'Data' => $this->clientCode . $guid . $numberOfInstallment . $transactionAmount . $totalAmount . $orderId . $this->failureUrl . $this->successUrl
        ])->SHA2B64Result;
    }

    /**
     * @param string $creditCardHolderName
     * @param string $creditCardNumber
     * @param string $creditCardMonth
     * @param string $creditCardYear
     * @param string $creditCardCvc
     * @param string $creditCardHolderGsm
     * @param string $orderId
     * @param string|null $orderDescription
     * @param int $numberOfInstallment
     * @param string $transactionAmount
     * @param string $totalAmount
     * @param string $transactionType
     * @param string|null $transactionId
     * @param string|null $ipAddress
     * @param string|null $refUrl
     * @param string|null $data1
     * @param string|null $data2
     * @param string|null $data3
     * @param string|null $data4
     * @param string|null $data5
     * @param string|null $data6
     * @param string|null $data7
     * @param string|null $data8
     * @param string|null $data9
     * @param string|null $data10
     */
    public function PosPayment(
        string $creditCardHolderName,
        string $creditCardNumber,
        string $creditCardMonth,
        string $creditCardYear,
        string $creditCardCvc,
        string $creditCardHolderGsm,
        string $orderId,
        string $orderDescription,
        int    $numberOfInstallment,
        string $transactionAmount,
        string $totalAmount,
        string $transactionType,
        string $transactionId = '',
        string $ipAddress = '88.247.47.164',
        string $refUrl = '',
        string $data1 = '',
        string $data2 = '',
        string $data3 = '',
        string $data4 = '',
        string $data5 = '',
        string $data6 = '',
        string $data7 = '',
        string $data8 = '',
        string $data9 = '',
        string $data10 = ''
    )
    {
        $hash = $this->SHA2B64(
            $this->guid,
            $numberOfInstallment,
            $transactionAmount,
            $totalAmount,
            $orderId
        );

        $parameters = [
            'G' => [
                'CLIENT_CODE' => $this->clientCode,
                'CLIENT_USERNAME' => $this->clientUsername,
                'CLIENT_PASSWORD' => $this->clientPassword,
            ],
            'GUID' => $this->guid,
            'KK_Sahibi' => $creditCardHolderName,
            'KK_No' => $creditCardNumber,
            'KK_SK_Ay' => $creditCardMonth,
            'KK_SK_Yil' => $creditCardYear,
            'KK_CVC' => $creditCardCvc,
            'KK_Sahibi_GSM' => $creditCardHolderGsm,
            'Hata_URL' => $this->failureUrl,
            'Basarili_URL' => $this->successUrl,
            'Siparis_ID' => $orderId,
            'Siparis_Aciklama' => $orderDescription,
            'Taksit' => $numberOfInstallment,
            'Islem_Tutar' => $transactionAmount,
            'Toplam_Tutar' => $totalAmount,
            'Islem_Hash' => $hash,
            'Islem_Guvenlik_Tip' => $transactionType,
            'Islem_ID' => $transactionId,
            'IPAdr' => $ipAddress,
            'Ref_URL' => $refUrl,
            'Data1' => $data1,
            'Data2' => $data2,
            'Data3' => $data3,
            'Data4' => $data4,
            'Data5' => $data5,
            'Data6' => $data6,
            'Data7' => $data7,
            'Data8' => $data8,
            'Data9' => $data9,
            'Data10' => $data10
        ];

        return $this->client->Pos_Odeme($parameters);
    }
}
