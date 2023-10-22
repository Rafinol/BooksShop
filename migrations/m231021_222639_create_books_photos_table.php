<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%books_photos}}`.
 */
class m231021_222639_create_books_photos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable('{{%books_photos}}', [
            'id'      => $this->primaryKey(),
            'book_id' => $this->integer(),
            'photo'   => $this->string(),
            'is_main' => $this->boolean()
        ]);

        $this->addForeignKey(
            'books_photos_book_id_to_books',
            '{{%books_photos}}',
            'book_id',
            '{{%books}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%books_photos}}');
    }
}
