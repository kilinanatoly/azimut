<?php

namespace app\modules\Tree\models;

use Yii;

/**
 * This is the model class for table "arenda_types_for_cats".
 *
 * @property integer $id
 * @property integer $arenda_type_id
 * @property integer $cat_id
 */
class ArendaTypesForCats extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'arenda_types_for_cats';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['arenda_type_id', 'cat_id'], 'required'],
            [['arenda_type_id', 'cat_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'arenda_type_id' => 'Arenda Type ID',
            'cat_id' => 'Cat ID',
        ];
    }
}
