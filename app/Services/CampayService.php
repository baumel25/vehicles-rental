<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CampayService
{
    protected $token;
    protected $baseUrl;
    protected $prefix;

    public function __construct()
    {
        $this->token = config('services.campay.token');
        $this->baseUrl = config('services.campay.base_url');
        $this->prefix = config('services.campay.prefix', 'LUX-');
    }

    /**
     * Collect payment from user
     */
    public function collect($phoneNumber, $amount, $description = "Reservation Deposit")
    {
        $externalReference = $this->prefix . time() . rand(100, 999);

        // Sanitize phone number (remove + if any)
        $phoneNumber = str_replace('+', '', $phoneNumber);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->baseUrl . '/collect/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode([
                "amount" => (string)$amount,
                "from" => $phoneNumber,
                "description" => $description,
                "external_reference" => $externalReference
            ]),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Token ' . $this->token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            Log::error("Campay Collect Error: " . $err);
            return ['success' => false, 'message' => $err];
        }

        return json_decode($response, true);
    }

    /**
     * Check transaction status
     */
    public function getStatus($reference)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->baseUrl . '/transaction/' . $reference . '/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Token ' . $this->token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            Log::error("Campay Status Error: " . $err);
            return null;
        }

        return json_decode($response, true);
    }

    /**
     * Withdraw/Refund money
     */
    public function withdraw($phoneNumber, $amount, $description = "Refund")
    {
        $phoneNumber = str_replace('+', '', $phoneNumber);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->baseUrl . '/withdraw/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode([
                "amount" => (string)$amount,
                "to" => $phoneNumber,
                "description" => $description,
                "external_reference" => ""
            ]),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Token ' . $this->token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            Log::error("Campay Withdraw Error: " . $err);
            return ['success' => false, 'message' => $err];
        }

        return json_decode($response, true);
    }
}
