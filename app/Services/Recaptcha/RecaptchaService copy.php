<?php

namespace App\Services\Recaptcha;

use Illuminate\Support\Facades\Http;

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

            $response = Http::post($url, [
                'secret'   => $secret,
                'response' => $recaptcha,
            ]);

            $resultJson = $response->json();

            if ($resultJson['success'] && $resultJson['score'] >= 0.5) {
                $valid = true;
            }

            // $recaptcha = file_get_contents($url . '?secret=' . config('constants.recaptcha.secret') . '&response=' . $recaptcha);
            // $resultJson = json_decode($recaptcha);
            // if ($resultJson->success) {
            //     if ($resultJson->score >= 0.5) {
            //         $valid = true;
            //     }
            // }
        } catch (\Throwable $th) {
            \Log::info($th->getMessage());
        }
        return $valid;
    }
}
