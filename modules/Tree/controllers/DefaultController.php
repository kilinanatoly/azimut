<?php

namespace app\modules\Tree\controllers;

use yii\web\Controller;
class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}