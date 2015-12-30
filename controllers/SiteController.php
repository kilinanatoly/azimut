<?php

namespace app\controllers;

use app\modules\arenda\models\Characteristics;
use app\modules\regions\models\ModArendaRegions;
use app\modules\Tree\models\CharacteristicsForCats;
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

    public function actionGetcharacteristics($id)
    {
        $result = CharacteristicsForCats::find()
            ->select(['characteristics_for_cats.*','characteristics.name AS characteristic_name'])
            ->where(['cat_id'=>$id])
            ->leftJoin('characteristics','characteristics_for_cats.character_id=characteristics.id')
            ->asArray()
            ->all();
        if (empty($result)){
            $cat = ModArendaTree::findOne(['id'=>$id]);
            while ($cat->parent_id!=0){
                $result = CharacteristicsForCats::find()
                    ->select(['characteristics_for_cats.*','characteristics.name AS characteristic_name','characteristics_products.value'])
                    ->where(['cat_id'=>$cat->parent_id])
                    ->leftJoin('characteristics','characteristics_for_cats.character_id=characteristics.id')
                    ->leftJoin('characteristics_products',['characteristics_products'])
                    ->asArray()
                    ->all();
                if (!empty($result)) break;
                $cat = ModArendaTree::findOne(['id'=>$cat->parent_id]);
            }
        }else{
        }
        if (!empty($result)){
            echo '<pre>';
            print_r($result);
            echo '</pre>';die;
            $html='';
            foreach ($result as $key => $value) {
                $html.='
                <div class="form-group">
                    <label><p>'.$value['characteristic_name'].'</p>
                    <input type="text" class="form-control" name="character['.$value['character_id'].']" >
                    </label>
                </div>
                ';
            }
            return $html;

        }else{
            return 'empty';
        }
    }

}
