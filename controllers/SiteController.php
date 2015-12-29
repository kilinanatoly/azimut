<?php

namespace app\controllers;

use app\modules\regions\models\ModArendaRegions;
use app\modules\Tree\models\ModArendaTree;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCatalog($item){
        if (strrpos($item,'/')){
            $item = trim(substr($item,strrpos($item,'/'),strlen($item)-strrpos($item,'/')));
        } else $item = trim($item);

        $result = ModArendaTree::findOne(['url'=>$item]);
        if (!$result) exit ('net');

        $result_parent = ModArendaTree::find()
            ->select(['mod_arenda_tree.*','images_for_cats.url AS image'])
            ->leftJoin('images_for_cats','images_for_cats.cat_id=mod_arenda_tree.id')
            ->groupBy('mod_arenda_tree.id')
            ->where(['parent_id'=>$result->id])
            ->asArray()
            ->all();
        if ($result_parent) return $this->render('cats',['data'=>$result_parent]);
        else {
            return $this->render('tovars',['data'=>123]);
        }
    }
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
