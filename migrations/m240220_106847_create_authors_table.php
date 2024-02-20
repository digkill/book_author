<?php

use app\infrastructure\db\Migration;

/**
 * Handles the creation of table `{{%authors}}`.
 */
class m240220_106847_create_authors_table extends Migration
{
    protected const TABLE_NAME = 'authors';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'is_active' => $this->tinyInteger()->notNull()->defaultValue(0),
            'creator_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull(),
        ]);

        $this->createForeignKeysForColumns($this->getFkColumns());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }

    private function getFkColumns(): array
    {
        return [
            'creator_id' => 'users'
        ];
    }
}
