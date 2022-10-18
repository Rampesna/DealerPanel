<?php

namespace App\SoapServices;

use SoapClient;
use WsdlToPhp\WsSecurity\WsSecurity;
use App\Traits\Response;

class UyumsoftSoapService
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
//        $this->baseUrl = 'http://efatura-test.uyumsoft.com.tr/Services/BasicDespatchIntegration?wsdl';
        $this->baseUrl = 'https://efatura-test.uyumsoft.com.tr/Services/DespatchIntegration?wsdl';
        $this->username = 'Uyumsoft';
        $this->password = 'Uyumsoft';
        $this->client = new SoapClient($this->baseUrl);

        $soapHeader = WsSecurity::createWsSecuritySoapHeader($this->username, $this->password, false);
        $this->client->__setSoapHeaders($soapHeader);
    }

    public function GetInboxDespatch()
    {
        $response = $this->client->GetInboxDespatch([
            'query' => [
                'despatchId' => '8a2d3526-effb-45f5-ab67-2c438efe974a',
            ]
        ]);

        return $response;
    }
}
