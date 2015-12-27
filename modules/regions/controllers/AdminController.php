<?php

namespace app\modules\regions\controllers;

use app\modules\arenda\models\GeobaseCity;
use app\modules\arenda\models\GeobaseRegion;
use Yii;
use yii\web\Controller;
use app\modules\regions\models\Functions;
use  yii\web\Session;


class AdminController extends Controller
{
    public $layout = '/admin';
    public function actionIndex()
    {
        @session_start();
        $_SESSION['menu'] = 2;
        $functions_model = new Functions();
        $model1 = new GeobaseRegion();

        if (Yii::$app->request->post('delete_city')) {
            $del_items = Yii::$app->request->post('delete_city');
            foreach ($del_items as $key => $value) {
                $city = GeobaseCity::findOne(['id' => $key]);
                $city->delete();
            }
        }
        if (Yii::$app->request->post('delete_region')) {
            $del_items = Yii::$app->request->post('delete_region');
            foreach ($del_items as $key => $value) {
                $city = GeobaseRegion::findOne(['id' => $key]);
                $city->delete();
            }
        }
        $success_region = [];
        if ($model1->load(Yii::$app->request->post()))
        {
            if (!empty($model1->name))
            {
                $model1->url = $functions_model->translit($model1->name);
                if ($model1->validate())
                {
                    if ($model1->save())
                    {
                        $success_region = $model1;
                    }
                }
            }
        }


        $regions = new GeobaseRegion();
        $cities = new GeobaseCity();
        $region_list = $regions->find()->asArray()->all();
        foreach ($region_list as $key => $value) {
            $cities = new GeobaseCity();
            $city_list = $cities->find()->where(['region_id' => $value['id']])->asArray()->all();
            $region_list[$key]['cities'] = $city_list;
        }
        return $this->render('index', ['region_list' => $region_list, 'model' => $cities, 'model1' => $regions,'success'=>$success_region]);
    }

    public function actionEditregion()
    {
        @session_start();
        $_SESSION['menu'] = 2;
        $regions = new GeobaseRegion();
        $region = $regions->findOne(['id'=>Yii::$app->request->get('region_id')]);
        if ($regions->load(Yii::$app->request->post())) {
            if ($regions->validate()) {
                $region = $regions->findOne(['id'=>Yii::$app->request->get('region_id')]);
                $region->name = $regions->name;
                $region->url = $regions->url;
                if ($region->save())
                {
                    $session = Yii::$app->session;
                    $session->setFlash('alerts', '<div class="alert alert-success">Изменения успешно сохранены</div>');
                    return $this->redirect('editregion?region_id='.Yii::$app->request->get('region_id'),['hui'=>'asd']);
                }
            }
        }
        return $this->render('edit_region', [
            'model' => $region,
        ]);
    }

    public function actionEditcity($city_id)
    {
        @session_start();
        $_SESSION['menu'] = 2;
        $cities = new GeobaseCity();
        $city = $cities->findOne(['id'=>$city_id]);
        $functions = new Functions();
        if ($cities->load(Yii::$app->request->post())) {

            if ($cities->validate()) {
                $city = $cities->findOne(['id'=>$city_id]);
                $city->name = $cities->name;
                $city->url = $functions->translit($city->name);
                if ($city->save())
                {
                    $session = Yii::$app->session;
                    $session->setFlash('editcity', '<div class="alert alert-success">Изменения успешно сохранены.</div>');
                    return $this->redirect(['editcity','city_id'=>$city_id]);
                }
            }
        }
        return $this->render('edit_city', [
            'model' => $city,
        ]);
    }

    public function actionCreate_city($id)
    {
        @session_start();
        $_SESSION['menu'] = 2;
        $functions_model = new Functions();
        $model = new GeobaseCity();

        if ($model->load(Yii::$app->request->post())) {
            if (empty($model->url)) $model->url = $functions_model->translit($model->name);

            if (!empty($model->name)) {

                $model->region_id = $id;

                    if ($model->validate())
                    {
                        if ($model->save())
                        {
                            $session = new Session;
                            $session->open();
                            $session = Yii::$app->session;
                            $session->setFlash('add_city', '<div class="alert alert-success">Вы успешно добавили город.</div>');
                            return $this->redirect('create_city?id='.$id);
                        }
                    }
            }
        }
        $region = GeobaseRegion::findOne(['id'=>$id]);
        return $this->render('edit_city', [
            'model' => $model,'region'=>$region
        ]);
    }
}
