<?php

namespace app\models;

use DateTime;
use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $released_year
 * @property string|null $description
 * @property string|null $isbn
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 *
 * @property Author[] $authors
 * @property BookStock $booksStock
 */
class Book extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['released_at', 'created_at', 'updated_at'], 'safe'],
            [['description'], 'string'],
            [['name', 'isbn'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id'          => 'ID',
            'name'        => 'Name',
            'released_at' => 'Released At',
            'description' => 'Description',
            'isbn'        => 'Isbn',
        ];
    }

    /**
     * Gets query for [[Authors]].
     *
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getAuthors(): ActiveQuery
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])
            ->viaTable('authors_books', ['book_id' => 'id']);
    }
}
