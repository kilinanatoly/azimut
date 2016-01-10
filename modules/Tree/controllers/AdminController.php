<?php

namespace app\modules\Tree\controllers;

use app\modules\regions\models\Functions;
use app\modules\regions\models\ModArendaCities;
use app\modules\regions\models\ModArendaRegions;
use app\modules\Tree\models\ArendaTypes;
use app\modules\Tree\models\ArendaTypesForCats;
use app\modules\Tree\models\CharacteristicsData;
use app\modules\Tree\models\CharacteristicsForCats;
use app\modules\Tree\models\CharacteristicsDataForCats;
use app\modules\Tree\models\ImagesForArendaTypes;
use app\modules\Tree\models\ImagesForCats;
use Yii;
use yii\web\Controller;
use app\modules\Tree\models\ModArendaTree;
use app\modules\Tree\models\Characteristics;
use  yii\web\Session;
use app\modules\Tree\models\UploadFile1;
use yii\web\UploadedFile;


class AdminController extends Controller
{
    public $layout = '/admin';
    public function actionIndex($parent_id=0)
    {
        @session_start();
        $_SESSION['menu'] = 1;
        $tree = new ModArendaTree();
        if (Yii::$app->request->post('sort')) {
            $sort = Yii::$app->request->post('sort');
            foreach ($sort as $key => $value) {
                if($value!=0){
                    if (empty($value)) {
                        unset($sort[$key]);
                    }
                }


            }
            foreach ($sort as $key => $value) {
                $m = ModArendaTree::findOne(['id' => $key]);

                    $m->sort = $value;
                    $m->save();


            }
        }
        if (Yii::$app->request->post('delete_item')) {
            $del_items = Yii::$app->request->post('delete_item');
            foreach ($del_items as $key => $value) {
                $item = ModArendaTree::findOne(['id' => $key]);
                $item->delete();
            }
        }

        if ($tree->load(Yii::$app->request->post())) {

            $function_model = new Functions();
            $tree->url = $function_model->translit($tree->name);
            $s = ModArendaTree::find()->where(['parent_id'=>$parent_id])->orderBy("sort DESC")->one();
            $tree->sort = (empty($s) ? 0 : $s->sort+10);
            $tree->parent_id = $parent_id;
            if (!empty($tree->name)) {
                if ($tree->save()){
                    $session = Yii::$app->session;
                    $session->setFlash('add_cat', '<div class="alert alert-success">Вы успешно добавили категорию.</div>');
                }
            }
        }
        $tree = new ModArendaTree();
        return $this->render('index', ['model' => $tree, 'data' => $tree->view_cat($tree->get_cat(),$parent_id),'parent_id'=>$parent_id]);
    }

    public function actionCreate($id)
    {
        @session_start();
        $_SESSION['menu'] = 1;
        $model = new ModArendaTree();
        if ($model->load(Yii::$app->request->post())) {

            $function_model = new Functions();
            $model->parent_id = $id;
            $s = ModArendaTree::find()->where(['parent_id'=>$id])->orderBy("sort DESC")->one();
            $model->sort = ($s ? $s->sort+10 : 0);
            $model->url = $function_model->translit($model->name);
            $model->active = 1;
            if ($model->validate()) {
                if ($model->save()) {
                    $session = new Session;
                    $session->open();
                    Yii::$app->session->set('catt',$model->name);
                    return $this->redirect('create?id='.$id);
                }
            }
        }
        $parent = $model->findOne(['id'=>$id]);
        return $this->render('create', [
            'model' => $model,'parent'=>$parent,
        ]);
    }

    public function actionEdit($id)
    {
        $model_upload = new UploadFile1();

        if (Yii::$app->request->isPost) {
            $model_upload->imageFile = UploadedFile::getInstance($model_upload, 'imageFile');
            if ($model_upload->upload($id)) {
                // file is uploaded successfully
            }
        }
        $icon = ImagesForCats::findOne(['cat_id'=>$id]);

        @session_start();
        $_SESSION['menu'] = 1;
        $model = new ModArendaTree();
        $item = $model->findOne(['id' => $id]);
        if ((Yii::$app->request->post())) {
            CharacteristicsForCats::deleteAll(['cat_id' => $id]);
            if ((Yii::$app->request->post('cats'))) {
                $cats = Yii::$app->request->post('cats');
                foreach ($cats as $key => $value) {
                    $model_ch = new CharacteristicsForCats();
                    $model_ch->cat_id = Yii::$app->request->post('ModArendaTree')['id'];
                    $model_ch->character_id = $key;
                    $model_ch->save();
                }
            }
            CharacteristicsDataForCats::deleteAll(['cat_id' => $id]);

            if ((Yii::$app->request->post('add_cat_for_character_data'))) {
                $cats = Yii::$app->request->post('add_cat_for_character_data');
              //  CharacteristicsForCats::deleteAll(['cat_id'=>$id]);
                foreach ($cats as $key => $value) {
                    $model_ch = new CharacteristicsDataForCats();
                    $model_ch->cat_id = Yii::$app->request->post('ModArendaTree')['id'];
                    $model_ch->character_data_id = $key;
                    $model_ch->save();

                    $char = CharacteristicsData::findOne(['id'=>$key]);
                    $model1 = CharacteristicsForCats::findOne(['character_id'=>$char->parent_id,'cat_id'=>$id]);
                    if (empty($model1)) $model1 = new CharacteristicsForCats();
                    $model1->cat_id = $id;
                    $model1->character_id = $char->parent_id;
                    $model1->save();
                }


            }



        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $item = $model->findOne(['id' => $id]);
                $item->name = $model->name;
                $item->url = $model->url;
                $item->parent_id = (empty($model->parent_id) ? $item->parent_id : $model->parent_id);
                $item->active = $model->active;
                $item->use_name_for_ads = $model->use_name_for_ads;
                $item->name_for_ads = $model->name_for_ads;
                $item->use_rub_km = $model->use_rub_km;
                if ($item->save()) {
                    $session = Yii::$app->session;
                    $session->setFlash('char1', '<div class="alert alert-success">Изменения успешно сохранены.</div>');
                    return $this->redirect('edit?id='.$id);
                }
            }
        }



        //получаем список категорий для изменения родителя
        $all_cats = $model->find()->asArray()->all();
        //получаем характеристики и подхарактеристики
        $all_characters = Characteristics::find()->asArray()->all();
        foreach ($all_characters as $key => $value) {
            $char_data = CharacteristicsData::find()->where(['parent_id' => $value['id']])->asArray()->all();
            if (!empty($char_data)) $all_characters[$key]['charact_data'] = $char_data;
        }
        //Получаем активные характеристики
        $active_cats = CharacteristicsForCats::find()->where(['cat_id' => $id])->asArray()->all();
        //Получаем активные подхарактеристики
        $active_podcats = CharacteristicsDataForCats::find()->where(['cat_id' => $id])->asArray()->all();
        //получаем типы аренды
        $tree = new ModArendaTree();

        return $this->render('edit', [
            'icon'=>$icon,
            'model_upload'=>$model_upload,
            'model' => $item,
            'all_cats' => $tree->view_cat_for_parent($tree->get_cat()),
            'all_characters' => $all_characters, 'active_cats' => $active_cats, 'active_podcats' => $active_podcats,
        ]);
    }

    public function actionCharact()
    {
        @session_start();
        $_SESSION['menu'] = 3;
        $model = new Characteristics();
        $model_data = new CharacteristicsData();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save()) {
                    $session = Yii::$app->session;
                    $session->setFlash('char', '<div class="alert alert-success">Вы успешно добавили техническую характеристику.</div>');
                    $id = Yii::$app->db->getLastInsertID();
                    if ($model->type=='textinput' || $model->type=='textarea'){
                        $model1 = new CharacteristicsData();
                        $model1->name = 'Текстовое поле';
                        $model1->parent_id = $id;
                        $model1->save();

                    }
                    return $this->redirect('charact');
                }
            }
        }

        if (Yii::$app->request->post('delete_character')) {
            $del_items = Yii::$app->request->post('delete_character');
            foreach ($del_items as $key => $value) {
                $character = Characteristics::findOne(['id' => $key]);
                $character->delete();
            }
        }

        $characters = $model->find()->asArray()->all();
        foreach ($characters as $key => $value) {
            $characters_data = new CharacteristicsData();
            $characters_list = $characters_data->find()->where(['parent_id' => $value['id']])->asArray()->all();
            $characters[$key]['characters_data'] = $characters_list;
        }

        return $this->render('characteristics', ['model' => $model, 'data' => $characters, 'characteristics_data' => $model_data]);
    }

    public function actionEditcharacterdata($parent_id, $id)
    {
        $characteristics = CharacteristicsData::findOne(['id' => $id]);
        $characteristics_par = Characteristics::findOne(['id' => $parent_id]);

        if (Yii::$app->request->post()) {
            $char_id = $id;
            CharacteristicsDataForCats::deleteAll(['character_data_id' => $char_id]);
            if (Yii::$app->request->post('cats')) {
                foreach (Yii::$app->request->post('cats') as $key3 => $value3) {
                    $char_for_cats_data = new CharacteristicsDataForCats();
                    $char_for_cats_data->character_data_id = $char_id;
                    $char_for_cats_data->cat_id = $key3;
                    $res = $char_for_cats_data->save();
                }
                if ($res){
                    $session = Yii::$app->session;
                    $session->setFlash('ch_data_isp', '<div class="alert alert-success">Изменения успешно сохранены.</div>');
                }
            }
        }

        if ($characteristics->load(Yii::$app->request->post())) {
            if ($characteristics->save()) {
                $session = Yii::$app->session;
                $session->setFlash('ch_data', '<div class="alert alert-success">Изменения успешно сохранены.</div>');
                return $this->redirect(['editcharacterdata','parent_id'=>$parent_id,'id'=>$id]);
            }
        }



        $charact_data_model = new CharacteristicsData();
        $charact_data = $charact_data_model->findOne(['id' => $id]);
        $charact_data_par = Characteristics::findOne(['id' => $parent_id]);
        $active_cats = CharacteristicsDataForCats::find()->where(['character_data_id' => $id])->asArray()->all();
        $cats_model = new ModArendaTree();
        $cats = $cats_model->view_cat_for_characters_data($cats_model->get_cat(), 0, $active_cats);


        return $this->render('edit_character_data', ['model' => $characteristics,'tree' => $cats,'par'=>$characteristics_par]);
    }

    public function actionEditcharacter($id)
    {
        @session_start();
        $_SESSION['menu'] = 3;
        $characteristics = Characteristics::findOne(['id' => $id]);
        if ($characteristics->load(Yii::$app->request->post())) {
            if ($characteristics->save()) {
                return $this->redirect('charact');
            }
        }
        return $this->render('edit_character', ['model' => $characteristics]);
    }

    public function actionViewcharact($id)
    {
        @session_start();
        $_SESSION['menu'] = 3;
        $model = new Characteristics();
        $model_data = new CharacteristicsData();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save()) {
                    return $this->redirect('charact');
                }
            }
        }

        if (Yii::$app->request->post('delete_character')) {
            $del_items = Yii::$app->request->post('delete_character');
            foreach ($del_items as $key => $value) {
                $character = Characteristics::findOne(['id' => $key]);
                $character->delete();
            }
            return $this->redirect('/tree/admin/charact');
        }

        if (Yii::$app->request->post()) {
            $char_id = $_GET['id'];

            CharacteristicsForCats::deleteAll(['character_id' => $char_id]);
            if (Yii::$app->request->post('cats')) {
                foreach (Yii::$app->request->post('cats') as $key3 => $value3) {
                    $char_for_cats = new CharacteristicsForCats();
                    $char_for_cats->character_id = $char_id;
                    $char_for_cats->cat_id = $key3;
                    $char_for_cats->save();
                }


            }
        }
        //получаем список характеристик
        $characters = $model->find()->where(['id' => $id])->asArray()->all();
        foreach ($characters as $key => $value) {
            $characters_data = new CharacteristicsData();
            $characters_list = $characters_data->find()->where(['parent_id' => $value['id']])->asArray()->orderBy(['name'=>SORT_ASC])->all();
            $characters[$key]['characters_data'] = $characters_list;
        }
        //Получаем активные категории
        $active_cats = CharacteristicsForCats::find()->where(['character_id' => $id])->asArray()->all();
        //получаем категории и подкатегории
        $cats_model = new ModArendaTree();
        $cats = $cats_model->view_cat_for_characters($cats_model->get_cat(), 0, $active_cats);


        return $this->render('view_charact', ['model' => $model, 'data' => $characters, 'characteristics_data' => $model_data, 'tree' => $cats]);
    }



    public function actionArendatypes()
    {
        @session_start();
        $_SESSION['menu'] = 4;
        $model = new ArendaTypes();
        if ($model->load(Yii::$app->request->post())) {
            $translit_model = new Functions();
            $model->url = $translit_model->translit($model->name);
            if ($model->validate()) {
                if ($model->save()) {
                    $session = Yii::$app->session;
                    $session->setFlash('add', '<div class="alert alert-success">Вы успешно добавили тип аренды.</div>');
                    return $this->redirect(array('arendatypes'));
                }
            }
        }
        if (Yii::$app->request->post('delete_character')) {
            $del_items = Yii::$app->request->post('delete_character');
            foreach ($del_items as $key => $value) {
                $character = Characteristics::findOne(['id' => $key]);
                $character->delete();
            }
        }
        //получаем список типов аренды
        $arenda_types  = $model->find()->asArray()->all();

        return $this->render('arenda_types', ['model' => $model, 'data' => $arenda_types]);
    }
    public function actionDeletecat($id)
    {
        $model = ModArendaTree::findOne(['id'=>$id]);
        if ($model->delete())
        {
            $session = Yii::$app->session;
            $session->setFlash('delete_cat', '<div class="alert alert-success">Вы успешно удалили категорию.</div>');
            return $this->redirect('index');
        }
    }
    public function actionViewarendatype($id)
    {
        @session_start();
        $_SESSION['menu'] = 4;
        if (Yii::$app->request->post())
        {
            ArendaTypesForCats::deleteAll(['arenda_type_id' => $id]);
            if (Yii::$app->request->post('delete_arenda_type'))
            {
                $delete_arenda_type = ArendaTypes::findOne(['id'=>key(Yii::$app->request->post('delete_arenda_type'))]);
                if ($delete_arenda_type->delete())
                {
                    return $this->redirect('arendatypes');
                }
            }
            else
            {
                if (Yii::$app->request->post('cats'))
                {
                    $arenda_types = Yii::$app->request->post('cats');
                    foreach ($arenda_types as $key=>$value)
                    {
                        $model_d_t = new ArendaTypesForCats();
                        $model_d_t->arenda_type_id = $id;
                        $model_d_t->cat_id = $key;
                        $model_d_t->save();
                    }
                }
            }
        }

        $model = new ArendaTypes();
        $arenda_type = $model->findOne(['id'=>$id]);

        //Получаем активные категории
        $active_cats = ArendaTypesForCats::find()->where(['arenda_type_id' => $id])->asArray()->all();
        //получаем категории и подкатегории
        $cats_model = new ModArendaTree();


        $cats = $cats_model->view_cat_for_characters($cats_model->get_cat(), 0, $active_cats);

        return $this->render('view_arenda_type', ['model' => $arenda_type,'tree'=>$cats]);
    }

    public function actionEditarendatype($id)
    {
        $model_upload = new UploadFile1();

        if (Yii::$app->request->isPost) {

            $model_upload->imageFile = UploadedFile::getInstance($model_upload, 'imageFile');
            $model_upload->imageFile1 = UploadedFile::getInstance($model_upload, 'imageFile1');
            if ($model_upload->upload1($id)) {
                // file is uploaded successfully
            }
        }
        $icon = ImagesForArendaTypes::findOne(['arenda_type_id'=>$id]);

        @session_start();
        $_SESSION['menu'] = 4;
        $arenda_type = ArendaTypes::findOne(['id' => $id]);
        if ($arenda_type->load(Yii::$app->request->post())) {
            if ($arenda_type->save()) {
                $session = Yii::$app->session;
                $session->setFlash('edit', '<div class="alert alert-success">Изменения успешно сохранены.</div>');
                return $this->redirect(['editarendatype','id'=>$id]);
            }
        }



        return $this->render('edit_arenda_type', ['model' => $arenda_type,
            'icon'=>$icon,
            'model_upload'=>$model_upload,
        ]);
    }


}
