<?php

namespace tests\unit\fixtures;

use app\models\Author;
use yii\test\ActiveFixture;

class AuthorFixture extends ActiveFixture
{
    public $modelClass = Author::class;

    public $dataFile = '@tests/unit/fixtures/data/author.php';
}
