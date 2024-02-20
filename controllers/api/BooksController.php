<?php

namespace app\controllers\api;

use app\models\Book;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class BooksController extends Controller
{
    /**
     * Book list
     *
     * @return array
     */
    public function actionList(): array
    {
        $this->layout = null;

        $bookList = Book::find()->all();

        Yii::$app->response->format = Response::FORMAT_JSON;
        return $bookList;
    }

}
