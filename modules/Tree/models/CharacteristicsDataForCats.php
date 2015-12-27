<?php

namespace app\modules\Tree\models;

use Yii;

/**
 * This is the model class for table "characteristics_data_for_cats".
 *
 * @property integer $id
 * @property integer $character_data_id
 * @property integer $cat_id
 */
class CharacteristicsDataForCats extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'characteristics_data_for_cats';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['character_data_id', 'cat_id'], 'required'],
            [['character_data_id', 'cat_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'character_data_id' => 'Character Data ID',
            'cat_id' => 'Cat ID',
        ];
    }
}
