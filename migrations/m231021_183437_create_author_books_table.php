<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%authors_books}}`.
 */
class m231021_183437_create_author_books_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable('{{%authors_books}}', [
            'author_id'  => $this->integer(),
            'book_id'    => $this->integer(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addPrimaryKey('pk-authors_books', '{{%authors_books}}', ['author_id', 'book_id']);

        $this->addForeignKey(
            'authors_books_author_id_to_authors',
            '{{%authors_books}}',
            'author_id',
            '{{%authors}}',
            'id'
        );

        $this->addForeignKey(
            'authors_books_book_id_to_books',
            '{{%authors_books}}',
            'book_id',
            '{{%books}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable('{{%authors_books}}');
    }
}
