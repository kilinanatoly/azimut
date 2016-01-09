<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "email_to".
 *
 * @property integer $id
 * @property string $email_to
 */
class EmailTo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email_to';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email_to'], 'required'],
            [['email_to'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email_to' => 'Получатели',
        ];
    }
}
