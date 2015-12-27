<?php

namespace app\modules\arenda\models;

use Yii;

/**
 * This is the model class for table "images_for_ads".
 *
 * @property integer $id
 * @property integer $ad_id
 * @property string $image_url
 */
class ImagesForAds extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images_for_ads';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ad_id', 'image_url'], 'required'],
            [['ad_id'], 'integer'],
            [['image_url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ad_id' => 'Ad ID',
            'image_url' => 'Image Url',
        ];
    }
}
