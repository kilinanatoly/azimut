<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "characteristics_products".
 *
 * @property integer $id
 * @property integer $character_id
 * @property string $value
 */
class CharacteristicsProducts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'characteristics_products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['character_id', 'value','product_id'], 'required'],
            [['character_id','product_id'], 'integer'],
            [['value'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'character_id' => 'Character ID',
            'value' => 'Value',
        ];
    }
}
