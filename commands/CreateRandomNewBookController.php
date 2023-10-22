<?php

namespace app\commands;

use app\dtos\AuthorDto;
use app\dtos\BookDto;
use app\exceptions\FailedCreateAuthorException;
use app\exceptions\FailedCreateBookException;
use app\exceptions\FailedCreateSubscriberException;
use app\models\Author;
use app\useCases\authors\CreateAuthorsService;
use app\useCases\authors\SubscribeUserForAuthorService;
use app\useCases\books\CreateBookService;
use DateTime;
use yii\console\Controller;
use yii\console\ExitCode;

class CreateRandomNewBookController extends Controller
{
    public function __construct(
        $id,
        $module,
        private readonly CreateAuthorsService $createAuthorsService,
        private readonly CreateBookService $createBookService,
        private readonly SubscribeUserForAuthorService $subscribeUserForAuthorService,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
    }

    public function actionIndex(): int
    {
        try {
            $author = $this->createAuthor();
            $this->subscribeUserForAuthorService->subscribeByPhone($author, '+71234459878');
            $this->createBook($author);
        } catch (FailedCreateAuthorException|FailedCreateBookException|FailedCreateSubscriberException $e) {
            $this->stdout($e->getMessage());
        }

        return ExitCode::OK;
    }

    /**
     * @throws FailedCreateAuthorException
     */
    private function createAuthor(): Author
    {
        $author = new AuthorDto();
        $author->setName("Фёдор");
        $author->setLastName("Достоевский");
        $author->setMiddleName("Михайлович");

        return $this->createAuthorsService->addNewAuthor($author);
    }


    /**
     * @throws FailedCreateBookException
     */
    private function createBook(Author $author): void
    {
        $bookDto = new BookDto();
        $bookDto->setName("Преступление и наказание");
        $bookDto->setIsbn("978-5-04-116676-2");
        $bookDto->setDescription(
            "Один из образов «Преступления и наказания» — большой город второй половины XIX века, жизнь в котором полна конфликтов и драм. Но то, что происходит в душах жителей этого города, оказывается гораздо масштабнее. Об убийстве Раскольниковым старухи-процентщицы слышали даже те, кто так и не открыл эту книгу. Но о том, что привело к трагедии, и особенно о том, что происходило с героем после нее, могут рассказать лишь поверхностно даже те, кто роман читал. Парадокс! Обусловленный невероятной психологической глубиной, на которую погрузился автор, исследуя проблему «сильной личности», не боящейся угрызений совести и людского суда. И огромным космосом человеческой души, который он оттуда достал."
        );
        $bookDto->setReleasedAt(new DateTime('12/01/2023'));
        $bookDto->setPhotos([
            ['photo' => 'https://ir.ozone.ru/s3/multimedia-d/wc1000/6736393453.jpg', 'is_main' => 1],
            ['photo' => 'https://ir.ozone.ru/s3/multimedia-n/wc1000/6726351911.jpg', 'is_main' => 0],
        ]);

        $this->createBookService->addNewBook($bookDto, [$author->id]);
    }
}
