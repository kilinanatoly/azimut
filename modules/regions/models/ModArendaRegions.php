<?php

namespace app\modules\regions\models;

use Yii;

/**
 * This is the model class for table "mod_arenda_regions".
 *
 * @property integer $id
 * @property string $name
 */
class ModArendaRegions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mod_arenda_regions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key_id'], 'required'],
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
            'name' => 'Название региона',
            'key_id' => 'URL',
        ];
    }
}
