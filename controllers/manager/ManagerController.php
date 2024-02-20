<?php

namespace app\controllers\manager;

use yii\filters\AccessControl;
use yii\web\Controller;
/**
 * BookController implements the CRUD actions for Book model.
 */
class ManagerController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['view', 'create', 'update', 'delete', 'index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view', 'create', 'update', 'delete', 'index'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
}
