<?php

namespace App\CrsService;

use Illuminate\Support\Facades\Http;

abstract class CrsService
{
    protected $baseUrl;

    protected $username;

    protected $password;

    public function __construct()
    {
        $this->baseUrl = 'http://connect.bienteknoloji.com.tr/api/BasicRemoteManagementApi';
        $this->username = 'AdminBien';
        $this->password = 'BiEn202211!';
    }

    protected function callApi($url, $method, $headers = [], $params = [], $body = [])
    {
        return Http::withHeaders($headers)->$method($url, $params);
    }
}
