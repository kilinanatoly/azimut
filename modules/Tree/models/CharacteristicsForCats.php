<?php

namespace app\modules\Tree\models;

use Yii;

/**
 * This is the model class for table "characteristics_for_cats".
 *
 * @property integer $id
 * @property integer $character_id
 * @property integer $cat_id
 */
class CharacteristicsForCats extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'characteristics_for_cats';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['character_id', 'cat_id'], 'required'],
            [['character_id', 'cat_id'], 'integer']
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
            'cat_id' => 'Cat ID',
        ];
    }
}
