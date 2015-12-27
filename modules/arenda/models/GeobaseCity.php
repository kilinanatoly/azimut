<?php

namespace app\modules\arenda\models;

use Yii;

/**
 * This is the model class for table "geobase_city".
 *
 * @property string $id
 * @property string $name
 * @property string $region_id
 * @property double $latitude
 * @property double $longitude
 */
class GeobaseCity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'geobase_city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['id', 'region_id'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['name','url'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'region_id' => 'Region ID',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
        ];
    }
}
