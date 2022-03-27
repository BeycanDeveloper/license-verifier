<?php

namespace Beycan;

class LicenseVerifier
{
    private static $verifyURL = 'https://beycanpress.com/?rest_route=/bplm-api/verify';

    /**
     * It checks the validity of the purchase licenseCode you entered and returns true false.
     * 
     * @param string $licenseCode
     * @return bool
     */
    public static function verify(string $licenseCode) : ?object
    {

        $headers = ["Content-Type: application/json"];

        $curl = curl_init(self::$verifyURL);
        curl_setopt_array($curl, [
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_REFERER => $_SERVER["SERVER_NAME"],
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => json_encode([
                "licenseCode" => trim($licenseCode)
            ]),
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false
        ]);

        $resp = json_decode(curl_exec($curl));

        curl_close($curl);
        
        return $resp ? $resp : null;
    }
}