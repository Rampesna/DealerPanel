<?php

namespace App\SoapServices;

use SoapClient;
use WsdlToPhp\WsSecurity\WsSecurity;
use App\Traits\Response;

class BienSoapService
{

    use Response;

    /**
     * @var string $baseUrl
     */
    protected $baseUrl;

    /**
     * @var SoapClient $client
     */
    protected $client;

    /**
     * @var string $clientUsername
     */
    protected $username;

    /**
     * @var string $clientPassword
     */
    protected $password;

    /**
     * @var string $token
     */
    protected $token;

    public function __construct()
    {
        $this->baseUrl = 'https://connect.bienteknoloji.com.tr/Services/RemoteManagement?wsdl';
        $this->username = 'AdminBien';
        $this->password = 'BN_2019_11!';
        $this->client = new SoapClient($this->baseUrl);


        $soapHeader = WsSecurity::createWsSecuritySoapHeader($this->username, $this->password, false);
        $this->client->__setSoapHeaders($soapHeader);
    }

    /**
     * @param string $startDate
     * @param string $endDate
     * @param string $taxNumber
     */
    public function GetCustomerReportWithSoftware(
        $startDate,
        $endDate,
        $taxNumber
    )
    {
        $response = $this->client->GetCustomerReportWithSoftware([
            'query' => [
                'StartDate' => $startDate,
                'EndDate' => $endDate,
                'VknTckn' => "$taxNumber",
            ]
        ]);

        return $response;
    }

    /**
     * @param string $startDate
     * @param string $endDate
     * @param string $taxNumber
     */
    public function GetCustomerReport()
    {
        $response = $this->client->GetCustomerReport([
            'query' => [
                'StartDate' => '2015-01-01T00:00:00',
                'EndDate' => '2050-01-01T00:00:00',
                'VknTckn' => '1700318993',
            ]
        ]);

        return $response;
    }
}
