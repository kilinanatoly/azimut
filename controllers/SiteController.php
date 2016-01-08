<?php

namespace app\controllers;

use app\models\BuyMessages;
use app\models\CallMeMain;
use app\models\CallMeMessages;
use app\models\CharacteristicsProducts;
use app\models\Comments;
use app\models\News;
use app\models\Products;
use app\models\ZaprosPriceMessages;
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
        @session_start();
        $_SESSION['current_str'] = 'index';
        return $this->render('index');
    }

    public function actionCatalog($item=''){
        @session_start();
        $_SESSION['current_str'] = 'catalog';
        $url = parse_url(Yii::$app->request->url);
        $url  = explode('/',$url['path']);


        if (strrpos($item,'/')){
            $item = trim(substr($item,strrpos($item,'/')+1,strlen($item)-strrpos($item,'/')));
        } else $item = trim($item);
        $result = ModArendaTree::findOne(['url'=>$item]);
        //���� �� ������� ���������, �������������� ��� �����, ����� ������ ������
        if (!$result) {
            $kroshka=[];
            foreach ($url as $key => $value) {
                if (!empty($value) && $value!=='catalog'){
                    if ($key!=count($url)-1){
                        $cat = ModArendaTree::findOne(['url'=>$value]);
                        if ($cat){
                            $kroshka['cats'][] = $cat;
                        }
                    }else{
                        $id = trim(substr($value,strrpos($value,'-')+1,strlen($value)-strrpos($value,'-')));
                        $tovar = Products::findOne(['id'=>$id]);
                        $kroshka['tovars'][] = $tovar;

                    }
                }
            }

            if (strrpos($item,'-')){
                $id = trim(substr($item,strrpos($item,'-')+1,strlen($item)-strrpos($item,'-')));
                $tovar = Products::findOne(['id'=>$id]);
                $characteristics = CharacteristicsProducts::find()
                    ->select(['characteristics_products.*','characteristics.name AS characteristic_name'])
                    ->where(['product_id'=>$id])
                    ->leftJoin('characteristics','characteristics_products.character_id=characteristics.id')
                    ->asArray()
                    ->all();
                $comments = Comments::find()->where(['product_id'=>$id])->andWhere(['moder'=>1])->asArray()->all();
                $pohozhie = Products::find()
                    ->where(['cat_id'=>$tovar->cat_id])
                    ->andWhere('id<>'.$tovar->id)
                    ->orderBy(['id'=>SORT_DESC])
                    ->asArray()
                    ->all();
                return $this->render('tovar',['data'=>$tovar,
                 'characteristics'=>$characteristics,
                'kroshka'=>$kroshka,
                'comments'=>$comments,
                'pohozhie'=>$pohozhie
                ]);
            }else{
                return $this->render('main_cats');
            }
        }

        $kroshka=[];
        foreach ($url as $key => $value) {
            if (!empty($value) && $value !== 'catalog') {
                $cat = ModArendaTree::findOne(['url' => $value]);
                if ($cat) {
                    $kroshka['cats'][] = $cat;
                }
            }
        }
        $result_parent = ModArendaTree::find()
            ->select(['mod_arenda_tree.*','images_for_cats.url AS image'])
            ->leftJoin('images_for_cats','images_for_cats.cat_id=mod_arenda_tree.id')
            ->groupBy('mod_arenda_tree.id')
            ->where(['parent_id'=>$result->id])
            ->asArray()
            ->all();
        if ($result_parent) return $this->render('cats',['data'=>$result_parent,
            'kroshka'=>$kroshka
        ]);
        else {
            $cat = ModArendaTree::findOne(['url'=>$item]);
            $char_for_cats = CharacteristicsForCats::find()
                ->select(['characteristics_for_cats.*','characteristics.name AS char_name'])
                ->where(['cat_id'=>$cat->id])
                ->leftJoin('characteristics','characteristics.id=characteristics_for_cats.character_id')
                ->orderBy(['character_id'=>SORT_DESC])
                ->asArray()
                ->all();
            if (empty($char_for_cats)){
                while ($cat->parent_id!=0){
                    $char_for_cats = CharacteristicsForCats::find()
                        ->select(['characteristics_for_cats.*','characteristics.name AS char_name'])
                        ->where(['cat_id'=>$cat->parent_id])
                        ->leftJoin('characteristics','characteristics.id=characteristics_for_cats.character_id')
                        ->orderBy(['character_id'=>SORT_DESC])
                        ->asArray()
                        ->all();
                    $cat = ModArendaTree::findOne(['id'=>$cat->parent_id]);
                }
            }
            if ($char_for_cats){
                //тут будет код если все охуенно
            }
            if (isset($_GET['view']) && $_GET['view']==2){
                $tovars = Products::find()
                    ->where(['cat_id'=>$result->id])
                    ->asArray()
                    ->all();
                foreach ($tovars as $key => $value) {
                    $chars = CharacteristicsProducts::find()
                        ->where(['product_id'=>$value['id']])
                        ->orderBy(['character_id'=>SORT_DESC])
                        ->asArray()
                        ->all();
                    $tovars[$key]['chars'] = $chars;
               }
                return $this->render('tovars',[
                    'data'=>$tovars,
                    'kroshka'=>$kroshka,
                    'chars'=>$char_for_cats
                ]);
            }else{
                $tovars = Products::find()
                    ->where(['cat_id'=>$result->id])
                    ->all();
                return $this->render('tovars',['data'=>$tovars,
                    'kroshka'=>$kroshka
                ]);
            }


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
                    ->select(['characteristics_for_cats.*','characteristics.name AS characteristic_name'
                        ])
                    ->where(['cat_id'=>$cat->parent_id])
                    ->leftJoin('characteristics','characteristics_for_cats.character_id=characteristics.id')
                    ->asArray()
                    ->all();
                if (!empty($result)) break;
                $cat = ModArendaTree::findOne(['id'=>$cat->parent_id]);
            }
        }else{
        }
        if (!empty($result)){
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
    //ПЕРЕЗВОНИТЕ МНЕ
    public function actionAdd_call_me_message($name,$email,$tel,$product_id){
        $model = new CallMeMessages();
        $model->name = $name;
        $model->email = empty($email) ? '' : $email;
        $model->tel = $tel;
        $model->product_id = $product_id;
        if ($model->save()){
            return 'success';
        }
        return false;
    }

    //ЗАПРОС СЧЕТ НА ОПЛАТУ
    public function actionAdd_buy_message($name,$email,$tel,$product_id){
        $model = new BuyMessages();
        $model->name = $name;
        $model->email = empty($email) ? '' : $email;
        $model->tel = empty($tel) ? '' : $tel;;
        $model->product_id = $product_id;
        if ($model->save()){
            return 'success';
        }
        return false;
    }

    //ЗАПРОС СТОИМОСТИ ТОВАРА
    public function actionAdd_price_zapros_message($name,$email,$tel,$product_id){
        $model = new ZaprosPriceMessages();
        $model->name = $name;
        $model->email = empty($email) ? '' : $email;
        $model->tel = empty($tel) ? '' : $tel;;
        $model->product_id = $product_id;
        if ($model->save()){
            return 'success';
        }
        return false;
    }

    public function actionView_news($id){
        $news = News::findOne(['id'=>$id]);
        return $this->render('view_news',['data'=>$news]);
    }
    public function actionNews(){
        $news = News::find()
            ->orderBy(['reg_date'=>SORT_DESC])
            ->asArray()
            ->all();
        return $this->render('news',['data'=>$news]);
    }

    public function actionAddcomment($name,$email,$comment,$product_id){
        $model = new Comments();
        $model->name = $name;
        $model->email = $email;
        $model->comment = $comment;
        $model->product_id = $product_id;
        if ($model->save()){
            return 'success';
        }
        return 'fail';
    }

    public function actionCallmemain($name,$tel){
        $model = new CallMeMain();
        $model->name = $name;
        $model->tel = $tel;
        if ($model->save()){
            return 'success';
        }
        return 'fail';
    }

}
