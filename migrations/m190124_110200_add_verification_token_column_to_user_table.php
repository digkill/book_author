<?php

use \yii\db\Migration;

class m190124_110200_add_verification_token_column_to_user_table extends Migration
{
    protected const TABLE_NAME = 'users';

    public function up()
    {
        $this->addColumn(self::TABLE_NAME, 'verification_token', $this->string()->defaultValue(null));
    }

    public function down()
    {
        $this->dropColumn(self::TABLE_NAME, 'verification_token');
    }
}
