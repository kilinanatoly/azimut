<?php

namespace app\modules\arenda\controllers;

use app\modules\arenda\models\CatsForAds;
use app\modules\arenda\models\CharacteristicsForAds;
use app\modules\arenda\models\GeobaseCity;
use app\modules\arenda\models\GeobaseRegion;
use app\modules\regions\models\ModArendaCities;
use app\modules\Tree\models\ArendaTypes;
use app\modules\Tree\models\ArendaTypesForCats;
use app\modules\arenda\models\Characteristics;
use app\modules\Tree\models\ModArendaTree;
use yii\web\Controller;
use app\modules\arenda\models\UploadFile;
use yii\web\UploadedFile;
use yii\db\Query;
use app\modules\arenda\models\Ads;
use app\modules\regions\models\Functions;
use Yii;

class DefaultController extends Controller
{

    public function actionIndex($city='',$user='')
    {
        if (!empty($city)) $from_city = GeobaseCity::findOne(['url'=>$city]);else $from_city='';
        $model = new Ads();
        $data = $model->Adss($from_city,$user);
           foreach($data as $key=>$value)
           {
               $data[$key]['catname'] = explode('::',$value['catname']);
               foreach($data[$key]['catname'] as $key2=>$value2)
               {
                   $data[$key]['catname'][$key2] = explode(':',$value2);
               }
           }
//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';die;
        return $this->render('index',['data'=>$data]);
    }

    public function actionView_ad($id)
    {
        $query = 'SELECT ads.*,GC.name AS city_name
        FROM ads
        LEFT JOIN geobase_city AS GC ON (ads.city_id=GC.id)
        WHERE ads.id='.$id.'
        GROUP BY ads.id
            ';
        $result = Yii::$app->db
            ->createCommand($query)
            ->queryOne();
        //делаем выборку фотографий
        $query = 'SELECT *
        FROM images_for_ads WHERE ad_id = '.$id.'
            ';
        $result_photos = Yii::$app->db
            ->createCommand($query)
            ->queryAll();

        return $this->render('view_ad',['data'=>$result,'photos'=>$result_photos]);

    }

    public function actionAdd()
    {
        $db = new Query();//подключаемся к классу бд
        //делаем выборку городов и регионов

        $query = 'SELECT GC.*,GR.name AS GR_name
            from geobase_city AS GC
            LEFT JOIN geobase_region AS GR ON (GC.region_id=GR.id)
            ORDER BY name ASC
            ';
        $regions = Yii::$app->db
            ->createCommand($query)
            ->queryAll();

        //делаем выборку категорий
        $cats = ModArendaTree::find()
        ->select(['mod_arenda_tree.*','images_for_cats.url AS image_url'])
        ->leftJoin('images_for_cats','images_for_cats.cat_id=mod_arenda_tree.id')
        ->where(['parent_id'=>0])->andWhere(['active'=>'1'])->orderBy(['sort'=>SORT_ASC])->asArray()->all();
        $model = new UploadFile();

        if (Yii::$app->request->post('asd'))
       {
           $ads = new Ads();
           $result = ModArendaTree::findOne(['id'=>Yii::$app->request->post('sel_cats')[0]]);

           if ($result->use_name_for_ads==0)
            {
                $naame='';
                foreach (Yii::$app->request->post('sel_cats') as $key => $value) {
                    $m = ModArendaTree::findOne(['id'=>$value]);
                    $naame = $naame.$m->name.' ';
                }
                $ads->name = $naame;

            }
           else{

               $ads->name = (empty(Yii::$app->request->post('ad_name')) ? 'Без названия' : Yii::$app->request->post('ad_name'));
           }

           $region_id = GeobaseCity::findOne(['id'=>Yii::$app->request->post('sel_regions')]);

            $ads->region_id = $region_id->region_id;
            $ads->city_id    = Yii::$app->request->post('sel_regions');
            $ads->min_arenda_hours = Yii::$app->request->post('min_arenda_hours');
            $ads->min_arenda_days = Yii::$app->request->post('min_arenda_days');
            $ads->arenda_price_hour = str_replace(' ', '', Yii::$app->request->post('arenda_price_hour'));
            $ads->arenda_price_day = str_replace(' ', '',Yii::$app->request->post('arenda_price_day'));
            $ads->arenda_price_km = str_replace(' ', '',Yii::$app->request->post('arenda_price_km'));
            $ads->zalog = !(Yii::$app->request->post('zalog')) ? 0 : str_replace(' ', '',Yii::$app->request->post('zalog'));
            $ads->oplata_nal = (Yii::$app->request->post('oplata_nal') ? Yii::$app->request->post('oplata_nal'): 'none');
            $ads->oplata_beznal = (Yii::$app->request->post('oplata_beznal') ? Yii::$app->request->post('oplata_beznal'): 'none');
            $ads->video_url = Yii::$app->request->post('video');
            $ads->email = Yii::$app->request->post('email');
            $ads->person = Yii::$app->request->post('person');
            $ads->comment = Yii::$app->request->post('comment');
            $ads->ad_type = Yii::$app->request->post('ad_type');
            if ($ads->save()) {
                $id = Yii::$app->db->getLastInsertID();
                if (Yii::$app->request->post('charact')){
                    foreach (Yii::$app->request->post('charact') as $key=>$value)
                    {
                        $char_for_ads = new CharacteristicsForAds();
                        $char_for_ads->ad_id = $id;
                        $char_for_ads->charact_id = $value;
                        $char_for_ads->save();
                    }
                }
                if (Yii::$app->request->post('charact2')){
                }
                if (Yii::$app->request->post('sel_cats')){
                    foreach (Yii::$app->request->post('sel_cats') as $key=>$value)
                    {
                        $cats_for_ads = new CatsForAds();
                        $cats_for_ads->ad_id = $id;
                        $cats_for_ads->cat_id = $value;
                        $cats_for_ads->save();
                    }
                }
                if (Yii::$app->request->isPost) {

                    $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
                    if (!empty($model->imageFiles)){
                        if ($model->upload($id)) {
                        }

                    }
                }
                return $this->render('success_add');

            }
        }

        return $this->render('add',['regions_and_cities'=>$regions,'categories'=>$cats,'model' => $model]);

    }

    public function actionGetcities($region_id)
    {
        $result = GeobaseCity::find()->where(['region_id'=>$region_id])->asArray()->all();
        $options='<option disabled selected>Выберите</option>';
        foreach ($result as $key=>$value)
        {
            $options.='<option value="'.$value['id'].'">'.$value['name'].'</option>';
        }
        return $options;
    }

    public function actionGetcats($cat_id)
    {

        $result = ModArendaTree::find()->where(['parent_id'=>$cat_id])->andWhere(['active'=>'1'])->asArray()->all();
        //unset($_SESSION['check']);
        if (count($result)>0)
        {


            $select='<ul>';
            foreach ($result as $key=>$value)
            {
                $select.='<li><a href="#" data-id="'.$value['id'].'">'.$value['name'].'</a></li>';
                if ($key%5==0 && $key!=0) $select.='</ul><ul>';
            }
            $select.='</ul>';
            return $select;
        }
        return 'empty';
    }

    public function actionCheck_for_view_ad_name($id)
    {

        $result = ModArendaTree::findOne(['id'=>$id]);
        if ($result->use_name_for_ads==1) return '1;'.$result->name_for_ads;else return '0;0';
    }
    public function actionGetarendatypes($id)
    {
        $result = ArendaTypesForCats::find()
            ->select(["arenda_types_for_cats.*","images_for_arenda_types.url","images_for_arenda_types.url_black"])
            ->leftJoin('images_for_arenda_types','arenda_types_for_cats.arenda_type_id=images_for_arenda_types.arenda_type_id')
            ->where(['cat_id'=>$id])
            ->asArray()
            ->all();
        while (empty($result)){
            $cat = ModArendaTree::findOne(['id'=>$id]);
            if ($cat->parent_id!=0){
                $result = ArendaTypesForCats::find()
                    ->select(["arenda_types_for_cats.*","images_for_arenda_types.*"])
                    ->leftJoin('images_for_arenda_types','arenda_types_for_cats.arenda_type_id=images_for_arenda_types.arenda_type_id')
                    ->where(['cat_id'=>$cat->parent_id])
                    ->asArray()
                    ->all();
                $id = $cat->parent_id;
            }
            else return 'none';
        }
        $options='';
        foreach ($result as $key=>$value)
        {
            $result2 = ArendaTypes::findOne(['id'=>$value['arenda_type_id']]);
            $options.='
            <div class="col-md-2 arenda_type_col">
                <label>
                    <input type="checkbox" value="'.$result2->id.'" name="arenda_type">

                    <span class="arenda_type_img">
                        <img class="img_blue" src="/images/arenda_types_images/'.$value['arenda_type_id'].'/'.$value['url'].'">
                        <img class="img_black"  style="display:none;" src="/images/arenda_types_images/'.$value['arenda_type_id'].'/'.$value['url_black'].'">
                    </span>

                </label>

                <span class="arenda_type_title">'.$result2->name.'</span>

            </div>';
        }
        return $options;
    }

    public function actionCheck_for_price_km($cat_id)
    {
        $result = ModArendaTree::findOne(['id'=>$cat_id]);
        while ($result->use_rub_km!=1){
            if ($result->parent_id!=0){
                $result = ModArendaTree::findOne(['id'=>$result->parent_id]);
            }else return 0;
        }

        return $result->use_rub_km;
    }

    public function actionGetcharacteristics($id)
    {

        $model = new Characteristics();
        $result = $model->getCharacteristics($id);
        while (empty($result))
        {
            $parent = ModArendaTree::findOne(['id'=>$id]);
            $parent = ModArendaTree::findOne(['id'=>$parent->parent_id]);
            if (empty($parent)){
                return false;
            }
            $result = $model->getCharacteristics($parent->id);
            $id = $parent->id;
        }
        return $result;
    }
}
