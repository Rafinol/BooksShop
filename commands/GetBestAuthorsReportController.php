<?php

namespace app\commands;

use app\useCases\reports\GetBestAuthorsForYearReport;
use Exception;
use yii\console\Controller;
use yii\helpers\Json;

class GetBestAuthorsReportController extends Controller
{
    public function __construct(
        $id,
        $module,
        private readonly GetBestAuthorsForYearReport $getBestAuthorsReport,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    /**
     * @throws Exception
     */
    public function actionIndex(): string
    {
        $authors = $this->getBestAuthorsReport->build(2017);

        return $this->stdout(PHP_EOL . Json::encode($authors) . PHP_EOL . PHP_EOL);
    }
}
