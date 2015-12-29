<?php

namespace app\modules\Tree\models;


use app\models\Products;
use app\modules\Tree\Tree;
use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
/**
 * This is the model class for table "mod_arenda_tree".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 */
class ModArendaTree extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $tree='';
    public $n='';
    public $nn=0;
    public static function tableName()
    {
        return 'mod_arenda_tree';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id','active','sort','use_name_for_ads','use_rub_km'], 'integer'],
            [['name','url','name_for_ads'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Добавить категорию',
            'parent_id' => 'Parent ID',
            'active'=>'Активность',
            'use_rub_km'=>'Прикрепить стоимость в км?',
            'use_name_for_ads'=>'Выводить название объявления при добавлении?'
        ];
    }
    public function get_cat() {
        $db = mysql_connect('localhost','root','');
        if (!$db) {
            exit('Ошибка при подключении к базе данных');
        }
        if(!mysql_select_db('farik',$db)) {
            exit('База данных не существует');
        }
        mysql_query('SET NAMES utf8');
        //запрос к базе данных
        $sql = "SELECT * FROM mod_arenda_tree ORDER BY sort ASC ";
        $result = mysql_query($sql);
        if(!$result) {
            return NULL;
        }
        $arr_cat = array();
        if(mysql_num_rows($result) != 0) {

            //В цикле формируем массив
            for($i = 0; $i < mysql_num_rows($result);$i++) {
                $row = mysql_fetch_array($result,MYSQL_ASSOC);

                //Формируем массив, где ключами являются адишники на родительские категории
                if(empty($arr_cat[$row['parent_id']])) {
                    $arr_cat[$row['parent_id']] = array();
                }
                $arr_cat[$row['parent_id']][] = $row;
            }
            //возвращаем массив
            return $arr_cat;
        }
    }


    function view_cat($arr,$parent_id = 0) {
        //Условия выхода из рекурсии
        if(empty($arr[$parent_id])) {
            return $this->tree;
        }
        $this->tree.='<ul>';
        //перебираем в цикле массив и выводим на экран
        for($i = 0; $i < count($arr[$parent_id]);$i++) {

            $this->tree.='<li>
                <span class="pl glyphicon glyphicon-chevron-down"></span>
                <a class="pll" href="'.Url::to(['/tree/admin?parent_id='.$arr[$parent_id][$i]['id']]).'">'
                .$arr[$parent_id][$i]['name'].'
                </a>'.($arr[$parent_id][$i]['active']==1 ? '<span title="Категория активна" class="glyphicon glyphicon-ok" style="margin:0 4px;"></span>' : '<span title="Категория НЕ активна" style="margin:0 4px;" class="glyphicon glyphicon-remove"></span>').'
                <a href="'.Url::to(['/tree/admin/edit', 'id' => $arr[$parent_id][$i]['id']]).'"><span class="glyphicon glyphicon-pencil" title="Редактировать"></span></a>
                <a href="'.Url::to(['/tree/admin/create', 'id' =>$arr[$parent_id][$i]['id']]).'">
                    <span style = "margin-left:5px;color:#4BBC07" class="glyphicon glyphicon-plus" title="Добавить"></span>
                </a>
                '.(!empty($arr[$arr[$parent_id][$i]['id']]) ? '<b style="margin-left:3px;">Удалить нельзя</b>': Html::checkbox('delete_item[' . $arr[$parent_id][$i]['id'] . ']', false, ['label' => 'Удалить', 'style' => 'margin-left:5px;'])).'<input  type="text" value="'.$arr[$parent_id][$i]['sort'].'" class="form-control" name="sort['.$arr[$parent_id][$i]['id'].']">'  ;
            //рекурсия - проверяем нет ли дочерних категорий

            $this->view_cat($arr,$arr[$parent_id][$i]['id']);
            $this->tree.= '</li>';
        }

        $this->tree.='</ul>';
        return $this->tree;
    }
    function view_cat_products($arr,$parent_id = 0) {
        //Условия выхода из рекурсии
        if(empty($arr[$parent_id])) {
            return $this->tree;
        }
        $this->tree.='<ul>';
        //перебираем в цикле массив и выводим на экран
        for($i = 0; $i < count($arr[$parent_id]);$i++) {
            $products = Products::find()->where(['cat_id'=>$arr[$parent_id][$i]['id']])->all();
            $product_list='<ul>';
            foreach ($products as $key => $value) {

                $product_list.='<li>'.$value['name'].'</li>';
            }
            $product_list.='</ul>';

            $this->tree.='<li>
                <span class="pl glyphicon glyphicon-chevron-down"></span>
                <a class="pll" href="#">'
                .$arr[$parent_id][$i]['name'].'
                </a>

                 '.(!empty($arr[$arr[$parent_id][$i]['id']]) ? '<b style="margin-left:3px;">Добавить нельзя</b>': '
                  <a href="'.Url::to(['/products/create', 'parent_id' =>$arr[$parent_id][$i]['id']]).'">
                    <span style = "margin-left:5px;color:#4BBC07" class="glyphicon glyphicon-plus" title="Добавить"></span>
                </a>').'
                 '  ;

            //рекурсия - проверяем нет ли дочерних категорий

            $this->view_cat_products($arr,$arr[$parent_id][$i]['id']);
            $this->tree.= $product_list.'</li>';
        }

        $this->tree.='</ul>';
        return $this->tree;
    }

    function view_cat_for_parent($arr,$parent_id = 0,$lvl=1) {
        $red_res = $this->findOne(['id'=>$_GET['id']]);
        $red_res = $this->findOne(['id'=>$red_res->parent_id]);
        if (!$red_res) {
          $red_res = new $this  ;
            $red_res->id = -1;
        }

        //Условия выхода из рекурсии
        if(empty($arr[$parent_id])) {
            return $this->tree;
        }
        $this->tree.='';
        $this->n = $this->n.'&nbsp;';
        //перебираем в цикле массив и выводим на экран
        $lvl++;
        for($i = 0; $i < count($arr[$parent_id]);$i++) {
            $this->tree.='<option '.($arr[$parent_id][$i]['id'] == $red_res->id ? "selected " : "").''.($arr[$parent_id][$i]['parent_id']==0 ? 'class="red"' : '').' value="'.$arr[$parent_id][$i]['id'].'">'.str_repeat('&nbsp;',$lvl*2).$arr[$parent_id][$i]['name'].'</option>'."\n"  ;

            $this->view_cat_for_parent($arr,$arr[$parent_id][$i]['id'],$lvl);
        }

        if ($i>0 ) {


        }
        return $this->tree;
    }

    function view_cat_for_characters($arr,$parent_id = 0,$act) {
        $new_act=[];
        foreach ($act as $key=>$value)
        {
            $new_act[] = $value['cat_id'];
        }
        //Условия выхода из рекурсии
        if(empty($arr[$parent_id])) {
            return $this->tree;
        }
        $this->tree.='<ul>';
        //перебираем в цикле массив и выводим на экран
        for($i = 0; $i < count($arr[$parent_id]);$i++) {
            if(in_array($arr[$parent_id][$i]['id'], $new_act))
            {
                $check = Html::checkbox('cats[' . $arr[$parent_id][$i]['id'] . ']', true, ['label' => '', 'style' => 'margin-left:5px;']);
            }
            else
            {
                $check = Html::checkbox('cats[' . $arr[$parent_id][$i]['id'] . ']', false, ['label' => '', 'style' => 'margin-left:5px;']);
            }
            $this->tree.='<li>'
                .$arr[$parent_id][$i]['name'].'<a href="/tree/admin/edit?id='.$arr[$parent_id][$i]['id'].'"><span  style="margin:0 4px;" title="Редактироаать"  class="glyphicon glyphicon-pencil"></span></a>'.''.$check  ;
            //рекурсия - проверяем нет ли дочерних категорий

            $this->view_cat_for_characters($arr,$arr[$parent_id][$i]['id'],$act);
            $this->tree.= '</li>';
        }
        $this->tree.='</ul>';
        return $this->tree;
    }

    function view_cat_for_characters_data($arr,$parent_id = 0,$act) {
        $new_act=[];
        foreach ($act as $key=>$value)
        {
            $new_act[] = $value['cat_id'];
        }
        //Условия выхода из рекурсии
        if(empty($arr[$parent_id])) {
            return $this->tree;
        }
        $this->tree.='<ul>';
        //перебираем в цикле массив и выводим на экран
        for($i = 0; $i < count($arr[$parent_id]);$i++) {

                if(in_array($arr[$parent_id][$i]['id'], $new_act))
                {
                    $check = Html::checkbox('cats[' . $arr[$parent_id][$i]['id'] . ']', true, ['label' => '', 'style' => 'margin-left:5px;']);
                }
                else
                {
                    $check = Html::checkbox('cats[' . $arr[$parent_id][$i]['id'] . ']', false, ['label' => '', 'style' => 'margin-left:5px;']);
                }

            $this->tree.='<li>'
                .$arr[$parent_id][$i]['name'].''.$check  ;
            //рекурсия - проверяем нет ли дочерних категорий

            $this->view_cat_for_characters_data($arr,$arr[$parent_id][$i]['id'],$act);
            $this->tree.= '</li>';
        }
        $this->tree.='</ul>';
        return $this->tree;
    }



}
