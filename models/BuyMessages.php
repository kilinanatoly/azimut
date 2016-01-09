<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "buy_messages".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $tel
 * @property integer $product_id
 */
class BuyMessages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'buy_messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','product_id'], 'required'],
            [['name', 'tel', 'email','inn','city'], 'string', 'max' => 255],
            [['comment'], 'string'],
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
            'email' => 'Email',
            'tel' => 'Tel',
            'product_id' => 'Product ID',
        ];
    }
}
