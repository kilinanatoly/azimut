<?php

namespace app\controllers;

use app\models\CharacteristicsProducts;
use app\modules\regions\models\ModArendaRegions;
use app\modules\Tree\models\ModArendaTree;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Products;
use yii\web\UploadedFile;
use app\modules\Tree\models\CharacteristicsForCats;

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

    public function actionShiny()
    {
        @session_start();
        $_SESSION['cat'] = 'shiny';
        $_SESSION['cat_r'] = 'Шины';
        $tree = new ModArendaTree();
        $T =  $tree->view_cat_products($tree->get_cat(),175);
        return $this->render('index',['tree'=>$T,
            'parent'=>'Шины'
        ]);
    }

    public function actionAkb()
    {
        @session_start();
        $_SESSION['cat'] = 'akb';
        $_SESSION['cat_r'] = 'Аккумуляторы АКБ';
        $tree = new ModArendaTree();
        $T =  $tree->view_cat_products($tree->get_cat(),176);
        return $this->render('index',['tree'=>$T,
            'parent'=>'Аккумуляторы АКБ'
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

            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->validate()) {
                if (!empty($model->imageFile)){
                    $model->upload();
                    $model->image = md5($model->imageFile->baseName.date("Y-m-d-H-i-s")) . '.' . $model->imageFile->extension;
                }


                $model->cat_id = $parent_id;
                if ($model->save()){
                    $last_id = Yii::$app->db->lastInsertID;
                    foreach (Yii::$app->request->post('character') as $key => $value) {
                            $model1 = new CharacteristicsProducts();
                            $model1->character_id = $key;
                            $model1->product_id = $last_id;
                            $model1->value = empty($value) ? 'none' : $value;
                            $model1->save();

                    }
                    return $this->redirect('create?parent_id='.$parent_id);
                }
                // form inputs are valid, do something here
            }
        }
        $parent = ModArendaTree::findOne(['id'=>$parent_id]);
        return $this->render('create', [
            'model' => $model,'parent'=>$parent
        ]);
    }

    public function actionEdit($id)
    {
        $model = Products::findOne(['id'=>$id]);
        $all_cats = ModArendaTree::find()->asArray()->all();


        if ($model->load(Yii::$app->request->post())) {
           $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->validate()) {
                if (!empty($model->imageFile)) {
                    $model->upload();
                    $model->image = md5($model->imageFile->baseName.date("Y-m-d-H-i-s")) . '.' . $model->imageFile->extension;

                }
                if ($model->save()){
                    $last_id = $_GET['id'];
                    foreach (Yii::$app->request->post('character') as $key => $value) {
                            $model1 =  CharacteristicsProducts::findOne(['product_id'=>$last_id,'character_id'=>$key]);
                            $model1->character_id = $key;
                            $model1->value = empty($value) ? 'none' : $value;
                            $model1->save();
                    }
                }
                // form inputs are valid, do something here
            }
        }




        $result = CharacteristicsForCats::find()
            ->select(['characteristics_for_cats.*','characteristics.name AS characteristic_name'])
            ->where(['cat_id'=>$model->cat_id])
            ->leftJoin('characteristics','characteristics_for_cats.character_id=characteristics.id')
            ->leftJoin('characteristics_products','characteristics_for_cats.character_id=characteristics_products.character_id')
            ->asArray()
            ->all();
        if (empty($result)){
            $cat = ModArendaTree::findOne(['id'=>$model->cat_id]);
            while ($cat->parent_id!=0){
                $result = CharacteristicsForCats::find()
                    ->select(['characteristics_for_cats.*','characteristics.name AS characteristic_name',
                 'characteristics_products.value AS VALUE'        ])
                    ->where(['cat_id'=>$cat->parent_id])
                    ->leftJoin('characteristics','characteristics_for_cats.character_id=characteristics.id')
                        ->leftJoin('characteristics_products','characteristics_for_cats.character_id=characteristics_products.character_id AND characteristics_products.product_id="'.$_GET['id'].'"')

                    ->asArray()
                    ->all();
                if (!empty($result)) break;
                $cat = ModArendaTree::findOne(['id'=>$cat->parent_id]);
            }
        }else{
        }
        $html='';
        if (!empty($result)){
            foreach ($result as $key => $value) {
                $VAL = (!empty($value['VALUE']) ? $value['VALUE']: '');
                $html.='
                <div class="form-group">
                    <label><p>'.$value['characteristic_name'].'</p>
                    <input value="'.$VAL.'" type="text" class="form-control" name="character['.$value['character_id'].']" >
                    </label>
                </div>
                ';
            }

            }







        return $this->render('edit', [
            'model' => $model,
            'all_cats' => $all_cats,
            'html'=>$html,

        ]);
    }


}
