<?php

namespace app\controllers\api;

use app\models\Subscription;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class SubscriptionController extends Controller
{

    /**
     * Book list
     *
     * @return array
     */
    public function actionSubscribe(): array
    {
        $this->layout = null;
        Yii::$app->response->format = Response::FORMAT_JSON;

        if ($this->request->isPost) {
            $model = new Subscription();
            $model->email = $this->request->post('email');
            $model->author_id = $this->request->post('author_id');
            $model->phone = $this->request->post('phone');

            if ($model->validate()) {
                $model->save();
                return ['id' => $model->id];
            }

            return ['errors' => $model->getErrors()];
        }

        return ['errors' => 'error'];
    }

}
