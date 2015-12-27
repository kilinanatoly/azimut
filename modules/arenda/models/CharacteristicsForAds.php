<?php

namespace app\modules\arenda\models;

use Yii;

/**
 * This is the model class for table "characteristics_for_ads".
 *
 * @property integer $id
 * @property integer $ad_id
 * @property integer $charact_id
 */
class CharacteristicsForAds extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'characteristics_for_ads';
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
            'charact_id' => 'Charact ID',
        ];
    }
}
