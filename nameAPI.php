<?php

class nameAPI {
    private const APIURL   = "https://api.name.com/v4";
    private const USERNAME = ""; // get https://www.name.com/account/settings/api
    private const TOKEN    = ""; // get https://www.name.com/account/settings/api
    /**
     * @var string
     */
    private $apiurl;
    /**
     * @var mixed
     */
    private string $api_username;
    private string $api_token;

    public function __construct(){
        $this->api_username = self::USERNAME;
        $this->api_token    = self::TOKEN;
        $this->apiurl       = self::APIURL;
    }

    public function info($domain){
        return self::get("/domains/$domain");
    }

    public function getPricing($domain){
        return self::get("/domains/$domain:getPricing");
    }

    public function search($domain){
        $data = ["keyword" => $domain];
        return self::post($data, "/domains:search");
    }

    public function checkAvailability($domain){
        $data = ["domainNames" => [$domain]];
        return self::post($data, "/domains:checkAvailability");
    }

    private function get($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::APIURL . $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_USERPWD, self::USERNAME . ':' . self::TOKEN);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return json_decode($result, true);
    }

    private function post($array, $url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.dev.name.com/v4/domains:search');
        curl_setopt($ch, CURLOPT_URL, $this->apiurl . $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($array));
        curl_setopt($ch, CURLOPT_USERPWD, "$this->api_username:$this->api_token");

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return json_decode($result, true);
    }
}


$nameAPI = new nameAPI();

$info = $nameAPI->info("example.org");
$getPricing = $nameAPI->getPricing("example.org");
$search = $nameAPI->search("example.org");
$checkAvailability = $nameAPI->checkAvailability("example.org");