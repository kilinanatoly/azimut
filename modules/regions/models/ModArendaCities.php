<?php

namespace app\modules\regions\models;

use Yii;

/**
 * This is the model class for table "mod_arenda_cities".
 *
 * @property integer $id
 * @property integer $region_id
 * @property string $name
 */
class ModArendaCities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mod_arenda_cities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id'], 'integer'],
            [['name','key_id'], 'string', 'max' => 255]
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
            'name' => 'Название',
        ];
    }

}
