<?php

namespace app\services\SmsSender;

use app\models\Author;
use app\models\Book;
use app\models\Subscription;
use Yii;

class SmsSender
{
    private readonly Book $book;
    private readonly Author $author;
    private SmsServiceInterface $service;

    public function __construct(Book $book, Author $author)
    {
        $this->book = $book;
        $this->author = $author;
        $this->service = Yii::$app->smsService;
    }

    public function send()
    {
        $subscription = Subscription::find()->where(['author_id' => $this->author->getAttribute('id')])->all();

        foreach ($subscription as $subscriber) {
            $message = "Вышла новая книга автора {$this->author->getAttribute('name')}: {$this->book->getAttribute('title')}";
            $this->service->send($subscriber->getAttribute('phone'), $message);
        }
    }
}