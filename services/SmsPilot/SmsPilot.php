<?php

namespace app\services\SmsPilot;

use app\services\SmsSender\SmsServiceInterface;
use Yii;
use yii\base\Component;

class SmsPilot extends Component implements SmsServiceInterface
{
    const API_KEY = 'XXXXXXXXXXXXYYYYYYYYYYYYZZZZZZZZXXXXXXXXXXXXYYYYYYYYYYYYZZZZZZZZ';

    public function send($phone, $message, $sender = 'INFORM'): bool
    {
        $url = 'https://smspilot.ru/api.php'
            . '?send=' . urlencode($message)
            . '&to=' . urlencode($phone)
            . '&from=' . $sender
            . '&apikey=' . self::API_KEY
            . '&format=json';

        $json = file_get_contents($url);

        $j = json_decode($json);
        if (!isset($j->error)) {
            Yii::error('SMS успешно отправлена server_id=' . $j->send[0]->server_id);
            return true;
        }
        Yii::error(print_r($j->error, 1));
        return false;
    }
}