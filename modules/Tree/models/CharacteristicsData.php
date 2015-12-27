<?php

namespace app\modules\Tree\models;

use Yii;

/**
 * This is the model class for table "characteristics_data".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 */
class CharacteristicsData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'characteristics_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'parent_id' => 'ID родителя',
        ];
    }

    public function getCharacteristics()
    {
        return $this->hasOne(Characteristics::className(), ['id' => $this->parent_id]);
    }
}
