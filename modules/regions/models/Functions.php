<?php

namespace app\modules\regions\models;

use app\models\Products;
use app\modules\Tree\models\ModArendaTree;
use Yii;
use yii\base\Model;

/**
 * This is the model class for table "mod_arenda_regions".
 *
 * @property integer $id
 * @property string $name
 */
class Functions extends Model
{
    /**
     * @inheritdoc
     */
    // функция превода текста с кириллицы в траскрипт
    function translit($str) {
        $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я',' ');
        $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'ZH', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', '', 'Y', 'E', 'E', 'Ju', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', '', 'y', '', 'e', 'ju', 'ya','-');
        return str_replace($rus, $lat, $str);
    }

    function get_tovar_url($id)
    {
        $tovar = Products::findOne(['id'=>$id]);
        $cat = ModArendaTree::findOne(['id'=>$tovar->cat_id]);
        $url = [];
        $url[] = $cat->url;
        while ($cat->parent_id!=0){
            $cat = ModArendaTree::findOne(['id'=>$cat->parent_id]);
            $url[] = strtolower($cat->url);
        }
        $total_url='/catalog';
        for ($i=count($url)-1;$i>=0;$i--){
            $total_url.='/'.$url[$i];
        }
        $total_url.='/'.strtolower($this->translit($tovar->name)).'-'.$tovar->id;
        return $total_url;
    }
    function current_url(){
        $url = parse_url(Yii::$app->request->url);
        $url = $url['path'];
        return $url;
    }

}
