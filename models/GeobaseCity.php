<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "geobase_city".
 *
 * @property integer $id
 * @property string $name
 * @property string $tel
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
            [['name', 'tel'], 'required'],
            [['name', 'tel'], 'string', 'max' => 255]
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
            'tel' => 'Телефон',
        ];
    }
}
