<?php

namespace app\controllers;

use app\repositories\BookRepository;
use yii\filters\AccessControl;
use yii\web\Controller;

class BooksController extends Controller
{
    public function __construct(
        $id,
        $module,
        private readonly BookRepository $bookRepository,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['edit', 'delete', 'create'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'subscribe'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['edit', 'delete', 'create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        $books = $this->bookRepository->getAll();

        return $this->render('index', compact('books'));
    }

    public function actionView(int $id): string
    {
        $book = $this->bookRepository->getById($id);

        return $this->render('view', compact('book'));
    }

    public function actionEdit(int $id): string
    {
        $book = $this->bookRepository->getById($id);

        return $this->render('view', compact('book'));
    }
}
