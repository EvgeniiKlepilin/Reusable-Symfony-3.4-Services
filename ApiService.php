<?php
namespace AppBundle\Service;

class ApiService
{
    const API_URL = "http://www.apisite.com/api/";

    private $login;
    private $password;
    private $sender;
    
    private $isTest = 0;

    /**
     * ApiService constructor.
     * @param $login
     * @param $password
     */
    public function __construct($login, $password, $sender)
    {
        $this->login = $login;
        $this->password = $password;
        $this->sender = $sender;
    }

    /**
     * @param $xml
     * @return mixed
     */
    public function makeRequest($xml, $endpoint)
    {
        $curl = curl_init(self::API_URL . $endpoint);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($curl, CURLOPT_TIMEOUT, 20*60); //timeout in seconds
        $xmlResult = curl_exec($curl);

        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if($httpcode >= 400){
            return array(
                'status' => $httpcode,
                'response' => [
                    'Error' => $xmlResult
                ]
            );
        }

        $xmlObject = simplexml_load_string($xmlResult, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xmlObject);
        $jsonArray['response'] = json_decode($json,TRUE);
        $jsonArray['status'] = 200;

        return $jsonArray;
    }

    public function defaultResponse($jsonArray){
        return new JsonResponse($jsonArray['response'], $jsonArray['status']);
    }

    public function sendMessage($id, $text, $time = null){
        $endpoint = "message";
        $xml = $this->getSendMessageBody($id, $text, $time);
        return $this->makeRequest($xml, $endpoint);
    }

    private function getSendMessageBody($id, $text, $time = null){
        $auth = $this->getAuthorization();
        return "<?xml version='1.0' encoding='utf-8'?>
                <message>
                    $auth 
                    <id>$id</id> 
                    <sender>$this->sender</sender> 
                    <text>$text</text>
                    <time>$time</time>
                    <test>$this->isTest</test>
                </message>";
    }

    private function getAuthorization(){
        return "<login>$this->login</login> 
                <pwd>$this->password</pwd>";
    }
}
