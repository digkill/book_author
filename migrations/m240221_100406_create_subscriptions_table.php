<?php

use app\infrastructure\db\Migration;

/**
 * Handles the creation of table `{{%subscriptions}}`.
 */
class m240221_100406_create_subscriptions_table extends Migration
{
    protected const TABLE_NAME = 'subscriptions';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'email' => $this->string(100)->notNull(),
            'phone' => $this->string(100)->notNull(),
            'is_active' => $this->tinyInteger()->notNull()->defaultValue(1),
            'author_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
