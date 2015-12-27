<?php

namespace app\modules\Tree\models;

use Yii;

/**
 * This is the model class for table "characteristics".
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 */
class Characteristics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'characteristics';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название характеристики',
            'type' => 'Тип характеристики',
        ];
    }
    public function getCharacteristicsData()
    {
        return $this->hasOne(CharacteristicsData::className(), ['parent_id' => $this->id]);
    }
}
