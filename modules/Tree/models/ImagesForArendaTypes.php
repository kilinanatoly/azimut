<?php

namespace app\modules\Tree\models;

use Yii;

/**
 * This is the model class for table "images_for_arenda_types".
 *
 * @property integer $id
 * @property string $url
 * @property integer $arenda_type_id
 */
class ImagesForArendaTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images_for_arenda_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'arenda_type_id'], 'required'],
            [['arenda_type_id'], 'integer'],
            [['url','url_black'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'arenda_type_id' => 'Arenda Type ID',
        ];
    }
}
