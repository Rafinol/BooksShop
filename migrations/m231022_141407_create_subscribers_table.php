<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subscribers}}`.
 */
class m231022_141407_create_subscribers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable('{{%subscribers}}', [
            'id'         => $this->primaryKey(),
            'phone'      => $this->string(30),
            'author_id'  => $this->integer(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey(
            'subscribers_author_id_to_authors',
            '{{%subscribers}}',
            'author_id',
            '{{%authors}}',
            'id'
        );

        $this->createIndex(
            'subscribers_phone_author_id',
            '{{%subscribers}}',
            ['phone', 'author_id'],
            true
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable('{{%subscribers}}');
    }
}
