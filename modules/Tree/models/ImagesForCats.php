<?php

namespace app\modules\Tree\models;

use Yii;

/**
 * This is the model class for table "images_for_cats".
 *
 * @property integer $id
 * @property string $url
 * @property integer $cat_id
 */
class ImagesForCats extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images_for_cats';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'cat_id'], 'required'],
            [['id', 'cat_id'], 'integer'],
            [['url'], 'string', 'max' => 255]
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
            'cat_id' => 'Cat ID',
        ];
    }
}
