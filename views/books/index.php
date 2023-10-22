<?php

/** @var yii\web\View $this */

$this->title = 'Все доступные книги';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <?php
            foreach ($books as $book): ?>
                <div><a href="books/view?id=<?= $book->id ?>"><?= $book->name ?></a></div>
            <?php
            endforeach; ?>
        </div>

    </div>
</div>
