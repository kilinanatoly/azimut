<?php

namespace app\modules\arenda\models;

use Yii;

/**
 * This is the model class for table "cats_for_ads".
 *
 * @property integer $id
 * @property integer $ad_id
 * @property integer $cat_id
 */
class CatsForAds extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cats_for_ads';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

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
            'cat_id' => 'Cat ID',
        ];
    }
}
