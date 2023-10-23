<?php

namespace app\controllers;

use yii\web\Controller;

class SiteController extends Controller
{
    public function actionLogin(): string
    {
        return $this->render('login');
    }
}
