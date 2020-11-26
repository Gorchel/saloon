<?php

namespace App\Classes\Integrations\Sender\Clients;

/**
 * Class Chat2Desc
 * @package App\Classes\Integrations\Sender\Clients
 */
class Chat2Desc implements ClientInterface
{
    /**
     * @var string
     */
    protected $url = "https://api.chat2desk.com/v1/";
    /**
     * @var string
     */
    protected $token = "7cec5f2966fe4ad8f6884bd267b02e";


    /**
     * @param string $template
     * @param array $option
     * @return bool
     */
    public function send(string $template, array $option = []): bool
    {
        $chat2descClientData = $this->getChat2DescClient($option['phone']);

        if ($chat2descClientData['status'] != 'success' || empty($chat2descClientData['data'])) {
            \Log::error('Chat2Desc not found client by phone '.$option['phone']);
            return false;
        }

        $clientId = $chat2descClientData['data'][0]['id'];
        $sendResponse = $this->sendTemplate($template, $clientId);

        if ($sendResponse['status'] == 'success') {
            return true;
        }

        return false;
    }

    /**
     * @param string $phone
     * @return mixed
     */
    protected function getChat2DescClient(string $phone)
    {
        $ch = curl_init( $this->url.'clients?phone='.$phone);
        curl_setopt( $ch, CURLOPT_ENCODING, "utf-8" );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
        curl_setopt( $ch, CURLOPT_TIMEOUT, 120 );
        curl_setopt( $ch, CURLOPT_HEADER, false );
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: '.$this->token,
        ));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec( $ch );
        curl_close( $ch );

        return json_decode($result, true);
    }

    /**
     * @param string $template
     * @param int $clientId
     * @return mixed
     */
    protected function sendTemplate(string $template, int $clientId)
    {
        $postParams = [
            'client_id' => $clientId,
            'transport' => 'whatsapp',
            'text' => $template,
        ];
        $postParamsStr = http_build_query($postParams);

        $ch = curl_init( $this->url.'messages?'.$postParamsStr);
        curl_setopt( $ch, CURLOPT_ENCODING, "utf-8" );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
        curl_setopt( $ch, CURLOPT_TIMEOUT, 120 );
        curl_setopt( $ch, CURLOPT_HEADER, false );
        curl_setopt( $ch, CURLOPT_POST, true);
//        curl_setopt( $ch, CURLOPT_POSTFIELDS, $postParamsStr );
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: '.$this->token,
            'Content-Type: application/json',
        ));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec( $ch );
        curl_close( $ch );

        return json_decode($result, true);
    }
}
