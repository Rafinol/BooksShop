<?php

namespace tests\unit\fixtures;

use app\models\AuthorBook;
use yii\test\ActiveFixture;

class AuthorBookFixture extends ActiveFixture
{
    public $modelClass = AuthorBook::class;

    public $depends = [BookFixture::class, AuthorFixture::class];

    public $dataFile = '@tests/unit/fixtures/data/author_book.php';
}