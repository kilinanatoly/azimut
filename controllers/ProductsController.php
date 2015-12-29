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
use app\models\Products;

class ProductsController extends Controller
{
    public $layout='admin';
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

    public function actionZapchasti()
    {
        @session_start();
        $_SESSION['cat'] = 'zapchasti';
        $_SESSION['cat_r'] = 'Запчасти';
        $tree = new ModArendaTree();
        $T =  $tree->view_cat_products($tree->get_cat(),174);
        return $this->render('index',['tree'=>$T,
        'parent'=>'Запчасти'
        ]);
    }

    public function actionCreate($parent_id)
    {
        @session_start();
        if (!isset($_SESSION['cat']) or !isset($_SESSION['cat_r'])){
            return $this->redirect('zapchasti');
        }
        $model = new Products();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->cat_id = $parent_id;
                if ($model->save()) return ;
                // form inputs are valid, do something here
            }
        }
        $parent = ModArendaTree::findOne(['id'=>$parent_id]);
        return $this->render('create', [
            'model' => $model,'parent'=>$parent
        ]);
    }


}
