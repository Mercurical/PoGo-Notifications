<?php

namespace AppBundle\Service\Bot;

/**
 * TODO: written in 20 minutes, ultra ugly and needs refactor :)
 * Class SimpleSkypeBot
 * @package AppBundle\Service\Bot
 */
class SimpleSkypeBot
{
    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $secret;

    public function __construct(string $apiKey, string $secret)
    {
        $this->apiKey = $apiKey;
        $this->secret = $secret;
    }

    private function getOAuth2Token(): string
    {
        $curl = curl_init("https://login.microsoftonline.com/botframework.com/oauth2/v2.0/token");

        $params = [
            "client_id" => $this->apiKey,
            "client_secret" => $this->secret,
            "grant_type" => "client_credentials",
            "scope" => "https://api.botframework.com/.default"
        ];

        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HEADER,'Content-Type: application/x-www-form-urlencoded');

        $postData = "";
        foreach($params as $k => $v)
        {
            $postData .= $k . '='.urlencode($v).'&';
        }

        $postData = rtrim($postData, '&');

        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);

        $jsonResponse = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($status != 200) {
            throw new \Exception("Error getting OAuth2 token (" . $status . "): " . curl_error($curl));
        }
        curl_close($curl);

        $result = json_decode($jsonResponse, true);

        return $result['access_token'];
    }

    public function sendMessage(string $message, string $receipent)
    {
        $token = $this->getOAuth2Token();

        $curl = curl_init("https://smba.trafficmanager.net/apis/v3/conversations/8:" . $receipent . "/activities");

        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, '{"type": "message","from": {"id": "' . $this->apiKey . '",},"text": "' . $message . '",}');
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Authorization: Bearer ' . $token]);

        curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($status != 200 && $status != 201) {
            throw new \Exception("Error sending a message (" . $status . "): " . curl_error($curl));
        }

        curl_close($curl);
    }
}