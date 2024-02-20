<?php

use app\infrastructure\db\Migration;

/**
 * Handles the creation of table `{{%books_and_authors}}`.
 */
class m240220_111339_create_books_and_authors_table extends Migration
{
    protected const TABLE_NAME = 'books_authors';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKeysForColumns($this->getFkColumns());

        $this->dropTable(self::TABLE_NAME);
    }


}
