<?php

namespace app\modules\arenda\models;

use Yii;

/**
 * This is the model class for table "geobase_region".
 *
 * @property string $id
 * @property string $name
 * @property string $url
 */
class GeobaseRegion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'geobase_region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'url'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['url'], 'string', 'max' => 255],
            [['id'], 'unique']
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
            'url' => 'Url',
        ];
    }
}
