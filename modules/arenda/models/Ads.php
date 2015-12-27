<?php

namespace app\modules\arenda\models;

use Yii;
use app\modules\arenda\models\GeobaseCity;

/**
 * This is the model class for table "ads".
 *
 * @property integer $id
 * @property integer $region_id
 * @property integer $city_id
 * @property integer $min_arenda_hours
 * @property integer $min_arenda_days
 * @property integer $arenda_price_hour
 * @property integer $arenda_price_day
 * @property double $zalog
 * @property string $oplata_nal
 * @property string $oplata_beznal
 * @property string $video_url
 * @property string $email
 * @property string $person
 */
class Ads extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ads';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','region_id', 'city_id', 'min_arenda_hours', 'min_arenda_days', 'arenda_price_hour', 'arenda_price_day', 'oplata_nal', 'oplata_beznal', 'email', 'person'], 'required'],
            [['region_id', 'city_id', 'min_arenda_hours', 'min_arenda_days', 'arenda_price_hour', 'arenda_price_day','arenda_price_km'], 'integer'],
            [['zalog'], 'number'],
            [['reg_date'], 'safe'],
            [['oplata_nal', 'oplata_beznal'], 'string', 'max' => 10],
            [['video_url', 'email'], 'string', 'max' => 255],
            [['name', ], 'string', 'max' => 300],
            [['person'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'region_id' => 'Region ID',
            'city_id' => 'City ID',
            'min_arenda_hours' => 'Min Arenda Hours',
            'min_arenda_days' => 'Min Arenda Days',
            'arenda_price_hour' => 'Arenda Price Hour',
            'arenda_price_day' => 'Arenda Price Day',
            'zalog' => 'Zalog',
            'oplata_nal' => 'Oplata Nal',
            'oplata_beznal' => 'Oplata Beznal',
            'video_url' => 'Video Url',
            'email' => 'Email',
            'person' => 'Person',
        ];
    }

    public function Adss($city,$user)
    {
        if ($user==2) $person_where = ' WHERE person="person_k "';
        elseif ($user==1) $person_where = ' WHERE person="person_ch "';
        else $person_where = ' WHERE 1=1 ';

        if (!empty($city)) $city_where = ' AND city_id='.$city->id.'';else $city_where='';

        $query = 'SELECT a.*,cities.name AS city_name,main_image.image_url AS main_image,
        GROUP_CONCAT(CONCAT(cats_join.id,":",cats.name) SEPARATOR "::")  AS catname from ads AS a
        LEFT JOIN geobase_city AS cities ON (a.city_id=cities.id)
        LEFT JOIN cats_for_ads AS cats_join ON (cats_join.ad_id=a.id)
        LEFT JOIN images_for_ads AS main_image ON (main_image.ad_id=a.id)
        LEFT JOIN mod_arenda_tree AS cats ON (cats_join.cat_id=cats.id) '.$person_where.$city_where.' GROUP BY a.id ORDER BY id DESC
        ';
        return Yii::$app->db
            ->createCommand($query)
            ->queryAll();
    }
}
