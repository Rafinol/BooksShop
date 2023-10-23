<?php

namespace tests\unit\fixtures;

use yii\test\ActiveFixture;

class BookPhotoFixture extends ActiveFixture
{
    public $tableName = 'books_photos';

    public $dataFile = '@tests/unit/fixtures/data/book_photo.php';
}
