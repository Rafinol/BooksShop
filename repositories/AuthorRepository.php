<?php

namespace app\repositories;

use app\dtos\AuthorDto;
use app\exceptions\FailedCreateAuthorException;
use app\exceptions\FailedCreateSubscriberException;
use app\helpers\DateHelper;
use app\models\Author;
use app\models\Subscriber;
use DateTime;
use yii\db\Query;

class AuthorRepository
{
    /**
     * @throws FailedCreateAuthorException
     */
    public function create(AuthorDto $authorDto): Author
    {
        $author = new Author();
        $author->name = $authorDto->getName();
        $author->last_name = $authorDto->getLastName();
        $author->middle_name = $authorDto->getMiddleName();
        $author->created_at = DateHelper::getCurrentStringDate();
        $author->updated_at = DateHelper::getCurrentStringDate();
        if (!$author->save()) {
            throw new FailedCreateAuthorException(implode(',', $author->getErrors()));
        }

        return $author;
    }

    /**
     * @throws FailedCreateSubscriberException
     */
    public function subscribeUserByPhone(int $authorId, string $subscriberPhone): void
    {
        $subscriber = new Subscriber();
        $subscriber->author_id = $authorId;
        $subscriber->phone = $subscriberPhone;
        $subscriber->created_at = DateHelper::getCurrentStringDate();
        $subscriber->updated_at = DateHelper::getCurrentStringDate();

        if (!$subscriber->save()) {
            throw new FailedCreateSubscriberException(implode(',', $subscriber->getErrors()));
        }
    }

    public function getAuthorsByPublicDate(DateTime $dateFrom, DateTime $dateTo, int $limit = null): array
    {
        $query = new Query();
        $select = [
            'authors.id',
            'authors.name',
            'authors.last_name',
            'authors.middle_name',
            'COUNT(books.id) as book_count'
        ];
        $startYear = $dateFrom->format('Y');
        $endYear = $dateTo->format('Y');
        $query->select($select)
            ->from('authors')
            ->innerJoin('authors_books', 'authors.id = authors_books.author_id')
            ->innerJoin('books', 'authors_books.book_id = books.id')
            ->where(['>=', 'released_year', $startYear])
            ->andWhere(['<=', 'released_year', $endYear])
            ->groupBy(['authors.id', 'authors.name'])
            ->orderBy(['book_count' => SORT_DESC]);
        if ($limit) {
            $query->limit($limit);
        }

        return $query->all();
    }
}