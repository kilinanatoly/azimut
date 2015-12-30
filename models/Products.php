<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $regdate
 * @property double $price
 * @property integer $active
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['name', 'description', 'price', 'active'], 'required'],
            [['description'], 'string'],
            [['regdate'], 'safe'],
            [['price'], 'number'],
            [['active','cat_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg','checkExtensionByMimeType'=>false],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
            'regdate' => 'Regdate',
            'price' => 'Цена',
            'active' => 'Активность',
            'imageFile' => 'Картинка',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('img/products/' . md5($this->imageFile->baseName.date("Y-m-d-H-i-s")) . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
