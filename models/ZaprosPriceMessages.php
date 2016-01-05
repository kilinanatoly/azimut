<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zapros_price_messages".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $tel
 * @property integer $product_id
 * @property string $reg_date
 */
class ZaprosPriceMessages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zapros_price_messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'product_id'], 'required'],
            [['id', 'product_id'], 'integer'],
            [['reg_date'], 'safe'],
            [['name', 'email', 'tel'], 'string', 'max' => 255]
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
            'reg_date' => 'Reg Date',
        ];
    }
}
