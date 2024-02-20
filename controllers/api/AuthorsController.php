<?php

namespace app\controllers\api;

use app\models\Author;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class AuthorsController extends Controller
{
    /**
     * Book list
     *
     * @return array
     */
    public function actionTop10(): array
    {
        $this->layout = null;
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('SELECT `authors`.id, `authors`.name, `books`.year_issue, COUNT(`books`.id) as count_book
            FROM `authors`
            INNER JOIN books_authors ON books_authors.author_id = `authors`.id
            INNER JOIN books ON books_authors.book_id = books.id
            GROUP BY `authors`.id, `books`.year_issue 
            ORDER BY count_book DESC');
        $authorTop10 = $command->queryAll();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $authorTop10;
    }

}
