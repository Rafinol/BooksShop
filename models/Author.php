<?php

namespace app\models;

use DateTime;
use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "authors".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $last_name
 * @property string|null $middle_name
 * @property DateTime $created_at
 * @property DateTime $updated_at
 *
 * @property Book[] $books
 */
class Author extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'last_name', 'middle_name'], 'string', 'max' => 255],
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
            'last_name'   => 'Last Name',
            'middle_name' => 'Middle Name',
        ];
    }


    /**
     * @throws InvalidConfigException
     */
    public function getBooks(): ActiveQuery
    {
        return $this->hasMany(Book::class, ['id' => 'book_id'])
            ->viaTable('author_books', ['author_id' => 'id']);
    }

    public function getSubscribers(): ActiveQuery
    {
        return $this->hasMany(Subscriber::class, ['author_id' => 'id']);
    }

    public function getSubscribersPhones(): array
    {
        return $this->getSubscribers()
            ->select('phone')
            ->asArray()
            ->all();
    }
}
