<?php

namespace App\BienCrmServices;

use Illuminate\Support\Facades\Cookie;

class BienCrmService
{
    protected $client;

    protected $baseUrl;

    protected $email;

    protected $password;

    protected $token;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
        $this->baseUrl = env('BIEN_CRM_API_BASE_URL');
        $this->email = env('BIEN_CRM_API_USER_EMAIL');
        $this->password = env('BIEN_CRM_API_USER_PASSWORD');

        $cookieToken = Cookie::get('bien_crm_token');
        if ($cookieToken) {
            $this->token = $cookieToken;
        } else {
            $this->token = $this->login();
        }
    }

    public function login()
    {
        $response = $this->client->post($this->baseUrl . 'authentication/login', [
            'form_params' => [
                'email' => $this->email,
                'password' => $this->password,
            ],
        ]);

        $token = json_decode($response->getBody()->getContents())->response->token;
        Cookie::queue('bien_crm_token', $token);
        return $token;
    }
}
