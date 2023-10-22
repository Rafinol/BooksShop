<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%books}}`.
 */
class m231021_171116_create_books_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable('{{%books}}', [
            'id'            => $this->primaryKey(),
            'name'          => $this->string(),
            'released_year' => $this->string(),
            'description'   => $this->text(),
            'isbn'          => $this->string(),
            'created_at'    => $this->dateTime(),
            'updated_at'    => $this->dateTime(),
        ]);

        $this->createIndex('released_at_books', '{{%books}}', 'released_year');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable('{{%books}}');
    }
}
