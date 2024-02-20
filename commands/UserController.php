<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\User;
use Yii;
use yii\base\Exception;
use yii\console\Controller;
use yii\console\ExitCode;

class UserController extends Controller
{

    /**
     * Generate demo users
     *
     * @return int
     * @throws Exception
     */
    public function actionIndex(): int
    {

        $user = new User();
        $user->username = 'admin';
        $user->email = 'admin@admin.ru';
        $user->status = User::STATUS_ACTIVE;
        $user->setPassword('admin');
        $user->generateAuthKey();
        $user->save();

        $user = new User();
        $user->username = 'demo';
        $user->email = 'demo@demo.ru';
        $user->status = User::STATUS_ACTIVE;
        $user->setPassword('demo');
        $user->generateAuthKey();
        $user->save();

        return ExitCode::OK;
    }
}
