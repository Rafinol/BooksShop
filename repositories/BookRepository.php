<?php

namespace app\repositories;

use app\dtos\BookDto;
use app\exceptions\FailedCreateBookException;
use app\helpers\DateHelper;
use app\models\Book;
use Exception;
use RuntimeException;
use Yii;

class BookRepository
{
    public function getAll(): array
    {
        return Book::find()->with('authors')->all();
    }

    public function getById(int $id): Book
    {
        return Book::find()->where(['id' => $id])->one();
    }

    /**
     * @throws FailedCreateBookException
     */
    public function create(BookDto $bookDto, array $authorsId): Book
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $book = $this->createBook($bookDto);
            $this->addPhotos($book->id, $bookDto->getPhotos());
            $this->assignAuthorsToBook($book->id, $authorsId);
            $transaction?->commit();
        } catch (Exception $e) {
            $transaction?->rollBack();
            throw new FailedCreateBookException($e);
        }

        return $book;
    }

    private function createBook(BookDto $bookDto): Book
    {
        $book = new Book();
        $book->name = $bookDto->getName();
        $book->released_year = $bookDto->getReleasedAt()->format('Y');
        $book->isbn = $bookDto->getIsbn();
        $book->description = $bookDto->getDescription();
        $book->created_at = DateHelper::getCurrentStringDate();
        $book->updated_at = DateHelper::getCurrentStringDate();
        $book->save();

        if ($book->save()) {
            return $book;
        }

        throw new RuntimeException('Не удалось сохранить книгу.');
    }

    /**
     * @throws \yii\db\Exception
     */
    public function addPhotos(int $bookId, array $photos): void
    {
        $insertPhotos = array_map(static function ($photo) use ($bookId) {
            return [$bookId, $photo['photo'], $photo['is_main']];
        }, $photos);

        Yii::$app->db->createCommand()
            ->batchInsert('books_photos', ['book_id', 'photo', 'is_main'], $insertPhotos)
            ->execute();
    }

    /**
     * @throws \yii\db\Exception
     */
    public function assignAuthorsToBook(int $bookId, array $authorIds): void
    {
        $currentDate = DateHelper::getCurrentStringDate();
        $authorBooks = array_map(static function (int $authorId) use ($bookId, $currentDate) {
            return [$authorId, $bookId, $currentDate, $currentDate];
        }, $authorIds);

        Yii::$app->db->createCommand()
            ->batchInsert('authors_books', ['author_id', 'book_id', 'created_at', 'updated_at'], $authorBooks)
            ->execute();
    }
}