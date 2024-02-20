<?php

use app\infrastructure\db\Migration;

/**
 * Handles the creation of table `{{%books}}`.
 */
class m240220_104752_create_books_table extends Migration
{
    protected const TABLE_NAME = 'books';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'year_issue' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'isbn' => $this->string(20)->notNull(),
            'photo_cover' => $this->string(255),
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
        $this->dropForeignKeysForColumns($this->getFkColumns());

        $this->dropTable(self::TABLE_NAME);
    }

    private function getFkColumns(): array
    {
        return [
            'creator_id' => 'users',
        ];
    }
}
