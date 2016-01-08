<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "call_me_main".
 *
 * @property integer $id
 * @property string $name
 * @property string $tel
 * @property string $regdate
 */
class CallMeMain extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'call_me_main';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'tel'], 'required'],
            [['regdate'], 'safe'],
            [['name', 'tel'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'tel' => 'Tel',
            'regdate' => 'Regdate',
        ];
    }
}
