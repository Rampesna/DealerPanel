<?php

namespace App\SoapServices;

use App\Models\Customer;
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
//        $this->baseUrl = 'http://connect-test.bienteknoloji.com.tr/Services/BasicRemoteManagement?wsdl';
        $this->baseUrl = 'https://connect.bienteknoloji.com.tr/Services/RemoteManagement?wsdl';
        $this->username = 'AdminBien';
        $this->password = 'BiEn202211!';
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
        $taxNumber = null
    )
    {
        $customer = Customer::where('tax_number', $taxNumber)->first();
        $response = $this->client->GetCustomerReportWithSoftware([
            'query' => [
                'StartDate' => $startDate,
                'EndDate' => $endDate,
                'VknTckn' => $taxNumber,
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

    public function GetCustomerStatusInformation()
    {
        $response = $this->client->GetCustomerStatusInformation([
            'query' => [
                'ActAsDataAdmin' => true,
                'PageIndex' => 0,
                'PageSize' => 4347,
                'VknTckn' => '31853334448',
            ]
        ]);

        return $response;
    }
}
