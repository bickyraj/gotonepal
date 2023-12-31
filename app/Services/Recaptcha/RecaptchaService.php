<?php

namespace App\Services\Recaptcha;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class RecaptchaService
{
    private static $recaptcha_url = "https://www.google.com/recaptcha/api/siteverify";

    public static function verifyRecaptcha($recaptcha)
    {
        $url = self::$recaptcha_url;
        $valid = false;
        try {

            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $secret = config('constants.recaptcha.secret');

            $client = new Client();

            $response = $client->post($url, [
                'form_params' => [
                    'secret'   => $secret,
                    'response' => $recaptcha,
                ],
            ]);

            $resultJson = json_decode($response->getBody(), true);

            if ($resultJson['success'] && $resultJson['score'] >= 0.5) {
                $valid = true;
            }

        } catch (\Throwable $th) {
            \Log::info($th->getMessage());
        }
        return $valid;
    }
}
