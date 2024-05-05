<?php
namespace Services;

use Exception;

class BoredRequestService
{
    protected string $url = 'https://www.boredapi.com/api/';

    /**
     * @param string $params
     * @return array
     * @throws Exception
     */
    protected function send(string $params = ''): array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url.$params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        if(curl_errno($ch)) {
            throw new Exception('Ошибка cURL: ' . curl_error($ch));
        }
        curl_close($ch);
        return json_decode($response, true) ?? [];
    }

    /**
     * @throws Exception
     */
    public function getRestAdvice(int $countParticipants, string $restType)
    {
        print_r($this->send("activity?participants=$countParticipants&type=$restType"));
    }
}