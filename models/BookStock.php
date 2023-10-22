<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books_stock".
 *
 * @property int $book_id
 * @property int|null $is_in_stock
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Books $book
 */
class BookStock extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books_stock';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_id'], 'required'],
            [['book_id', 'is_in_stock'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['book_id'], 'unique'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Books::class, 'targetAttribute' => ['book_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'book_id' => 'Book ID',
            'is_in_stock' => 'Is In Stock',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Book]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Books::class, ['id' => 'book_id']);
    }
}
