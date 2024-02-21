<?php

namespace app\listeners;


use app\events\MessageSendEvent;
use app\services\SmsSender\SmsSender;
use Yii;

class MessageSendListener
{
    public static function handleSend(MessageSendEvent $event): void
    {
        (new SmsSender($event->book, $event->author))->send();
    }
}