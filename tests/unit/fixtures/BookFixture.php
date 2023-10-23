<?php

namespace tests\unit\fixtures;

use app\models\Book;
use yii\test\ActiveFixture;

class BookFixture extends ActiveFixture
{
    public $modelClass = Book::class;

    public $dataFile = '@tests/unit/fixtures/data/book.php';
}
