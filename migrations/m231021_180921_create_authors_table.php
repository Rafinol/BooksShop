<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%authors}}`.
 */
class m231021_180921_create_authors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable('{{%authors}}', [
            'id'          => $this->primaryKey(),
            'name'        => $this->string(),
            'last_name'   => $this->string(),
            'middle_name' => $this->string(),
            'created_at'  => $this->dateTime(),
            'updated_at'  => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable('{{%authors}}');
    }
}
