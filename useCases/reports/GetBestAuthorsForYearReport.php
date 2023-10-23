<?php

namespace app\useCases\reports;

use app\repositories\AuthorRepository;
use DateTime;
use Exception;

readonly class GetBestAuthorsForYearReport
{
    public function __construct(private AuthorRepository $bookRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function build(int $year, int $limit = null): array
    {
        $dateFrom = new DateTime($year . '-01-01 00:00:00');
        $dateTo = new DateTime($year . '-12-31 23:59:59');

        return $this->bookRepository->getAuthorsByPublicDate($dateFrom, $dateTo, $limit);
    }
}
