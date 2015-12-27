<?php

namespace app\modules\arenda\models;

use Yii;
use yii\db\Query;


/**
 * This is the model class for table "cats_for_ads".
 *
 * @property integer $id
 * @property integer $ad_id
 * @property integer $cat_id
 */
class Characteristics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function getcharacteristics($id)
    {
        $db = new Query();//подключаемся к классу бд
        //делаем выборку городов и регионов
//        $db = new \yii\db\Connection([ 'dsn' => 'mysql:host=localhost;dbname=yii2basic',
//            'username' => 'root',
//            'password' => '',
//            'charset' => 'utf8',]);
//
//
//        //,GROUP_CONCAT(CONCAT(CD.name,':',CD.id) SEPARATOR '::') AS `charact_data`
////        LEFT JOIN `characteristics` as C ON (C.id = CFC.character_id)
////              LEFT JOIN `characteristics_data` as CD ON (CD.parent_id = C.id)
//        $res = $db->createCommand("
//        SELECT * FROM `characteristics_data` as D
//        INNER JOIN `characteristics_data_for_cats` as DFC ON (DFC.cat_id='36' AND DFC.character_data_id=D.id)
//        WHERE D.parent_id='16'
//        GROUP BY D.id
//        ")->queryAll();
//        echo '<pre>';
//        print_r($res);
//        echo '</pre>';die;


        $regions = $db
            ->select(["C.id as CID,C.type as CTYPE,C.name as CNAME,C.id as charact_id,GROUP_CONCAT(CONCAT(CD.name,':',CD.id) SEPARATOR '::') AS charact_data"])
            ->from('characteristics_data_for_cats AS CDFC')
            ->where('CDFC.cat_id = '.$id)
            ->join('LEFT JOIN', 'characteristics_data as CD','CD.id = CDFC.character_data_id')
            ->join('LEFT JOIN', 'characteristics AS C', 'CD.parent_id = C.id')
            ->groupBy('CDFC.id')
            ->all();
//        if (empty($regions))
//        {
//            $parent = ModArendaTree::findOne(['id'=>$id]);
//            $parent = ModArendaTree::findOne(['id'=>$parent->parent_id]);
//            return $this->redirect('getcharacteristics?id='.$parent->id);
//        }
        foreach ($regions as $key=>$value)
        {
            $new_regions[$value['charact_id']]['name'] = $value['CNAME'];
            $new_regions[$value['charact_id']]['type'] = $value['CTYPE'];
            $new_regions[$value['charact_id']]['id'] = $value['CID'];
            $new_regions[$value['charact_id']]['values'][] = explode(':',$value['charact_data']);
        }

        $select='';
        if (!empty($new_regions)){
            foreach ($new_regions as $key=>$value)
            {

                if ($value['type']=='select'){
                    $select.='<div class="form-group char_add"><label for="sel_cats">'.$value['name'].'</label><select class="form-control" name="charact[]"><option disabled="" selected="">Выберите</option>';
                    foreach ($value['values'] as $key2=>$value2)
                    {
                        $select.='<option value='.$value2[1].'>'.$value2[0].'</option>';

                    }
                    $select.='</select></div>';
                }

                if ($value['type']=='radio'){
                    $select.='<div class="form-group arenda_type_add"><b>'.$value['name'].'</b>';
                    foreach ($value['values'] as $key2=>$value2)
                    {
                        $select.='<p><label><input name="charact['.$value['id'].']" type="radio" value='.$value2[1].'>'.$value2[0].'</label></p>
                         ';
                    }
                    $select.='</div>';
                }
                if ($value['type']=='checkbox'){
                    $select.='<div class="form-group arenda_type_add"><b>'.$value['name'].'</b>';
                    foreach ($value['values'] as $key2=>$value2)
                    {
                        $select.='<p><label><input name="charact['.$value['id'].']" type="checkbox" value='.$value2[1].'>'.$value2[0].'</label></p>';
                    }
                    $select.='</div>';
                }
                if ($value['type']=='textinput'){

                    $select.='<div class="form-group arenda_type_add"><b>'.$value['name'].'</b>';
                    $select.='<p><input name="charact2[]" type="text"></p>';
                    $select.='</div>';
                }

                if ($value['type']=='textarea'){
                    $select.='<div class="form-group arenda_type_add">'.$value['name'];
                    $select.='<textarea name="charact2[]"></textarea>';
                    $select.='</div>';
                }




            }
        }


        return $select;
    }
}
