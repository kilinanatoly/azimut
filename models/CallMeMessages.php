<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "call_me_messages".
 *
 * @property integer $id
 * @property string $name
 * @property string $tel
 * @property string $email
 */
class CallMeMessages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'call_me_messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','product_id'], 'required'],
            [['name', 'tel', 'email'], 'string', 'max' => 255],
            [['product_id'], 'integer']
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
            'email' => 'Email',
        ];
    }
}
