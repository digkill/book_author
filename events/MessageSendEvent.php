<?php

namespace app\events;

use app\models\Author;
use app\models\Book;
use yii\base\Event;

class MessageSendEvent extends Event
{
    const EVENT_MESSAGE_SEND = 'message-send-event';

    public function __construct(public Book $book, public Author $author, $config = [])
    {
        parent::__construct($config);
    }
}