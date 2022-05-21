<?php

namespace Modules\Acl\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

trait otpTrait
{
    public function sendOTP($to = '966592031195', $code)
    {
        //APf731aa7b18554128b8c1d696c89fcbc8
        //eyJhbGciOiJIUzI1NiJ9.eyJzZXJ2aWNlX2lkIjoiQVBmNzMxYWE3YjE4NTU0MTI4YjhjMWQ2OTZjODlmY2JjOCJ9.NtKYOUXuT1Aa3MByKJk7DlZ59WDBT32gpAWTh2Ia-Rw
        try {
            $client = new Client();
            $response = $client->post('https://authenticate.cloud.api.unifonic.com/services/api/v2/verifications/check', [
                'json' => [
                    'to' => '+'.$to,
                    'channel' => 'sms',
                    'code' => $code,
                    'locale' => 'en'
                ],
                'headers' => [
                    'Accept' => 'application/json',
                    'x-authenticate-app-id' => getValueSetting('otp_app_id') ,
                    'Authorization' => getValueSetting('otp_Authorization')
                ],
            ]);

            if ($response->getStatusCode() == 200) {
                return true;
            }
            return false;
        } catch (RequestException $e) {
            //todo make log error
            return false;
        }

    }
}
