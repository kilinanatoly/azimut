<?php
namespace app\modules\Tree\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadFile1 extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $imageFile1;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg','checkExtensionByMimeType'=>false],
            [['imageFile1'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg','checkExtensionByMimeType'=>false],
        ];
    }

    public function upload($cat_id)
    {
        if (!empty($this->imageFile)){
            if ($this->validate()) {
                if (!file_exists("../web/images/cats_images/".$cat_id))
                {
                    mkdir("../web/images/cats_images/".$cat_id, 0777);
                }

                $image_name = md5($this->imageFile->baseName).date('His') . '.' . $this->imageFile->extension;
                $this->imageFile->saveAs('images/cats_images/'.$cat_id.'/'. $image_name);
                $model = ImagesForCats::findOne(['cat_id'=>$cat_id]);
                if (!empty($model)){
                    if (file_exists("../web/images/cats_images/".$cat_id.'/'.$model->url)){
                        unlink("../web/images/cats_images/".$cat_id.'/'.$model->url);
                    }
                }
                if (empty($model)) $model = new ImagesForCats();
                $model->url = $image_name;
                $model->cat_id = $cat_id;
                $model->save();

                return true;
            } else {
                return false;
            }
        }

    }
    public function upload1($arenda_type_id)
    {
        if (!empty($this->imageFile)){
            if ($this->validate()) {
                if (!file_exists("../web/images/arenda_types_images/".$arenda_type_id))
                {
                    mkdir("../web/images/arenda_types_images/".$arenda_type_id, 0777);
                }

                $image_name = md5($this->imageFile->baseName).date('His') . '.' . $this->imageFile->extension;
                $this->imageFile->saveAs('images/arenda_types_images/'.$arenda_type_id.'/'. $image_name);
                $model = ImagesForArendaTypes::findOne(['arenda_type_id'=>$arenda_type_id]);
                if (!empty($model)){
                    if (file_exists("../web/images/arenda_types_images/".$arenda_type_id.'/'.$model->url)){
                        unlink("../web/images/arenda_types_images/".$arenda_type_id.'/'.$model->url);
                    }
                }
                if (empty($model)) $model = new ImagesForArendaTypes();
                $model->url = $image_name;
                $model->arenda_type_id = $arenda_type_id;
                $model->save();

                return true;
            } else {
                return false;
            }
        }

        if (!empty($this->imageFile1)){
            if ($this->validate()) {
                if (!file_exists("../web/images/arenda_types_images/".$arenda_type_id))
                {
                    mkdir("../web/images/arenda_types_images/".$arenda_type_id, 0777);
                }

                $image_name = md5($this->imageFile1->baseName).date('His') . '.' . $this->imageFile1->extension;
                $this->imageFile1->saveAs('images/arenda_types_images/'.$arenda_type_id.'/'. $image_name);
                $model = ImagesForArendaTypes::findOne(['arenda_type_id'=>$arenda_type_id]);
                if (!empty($model)){
                    if (file_exists("../web/images/arenda_types_images/".$arenda_type_id.'/'.$model->url_black)){
                        unlink("../web/images/arenda_types_images/".$arenda_type_id.'/'.$model->url_black);
                    }
                }
                if (empty($model)) $model = new ImagesForArendaTypes();
                $model->url_black = $image_name;
                $model->arenda_type_id = $arenda_type_id;
                $model->save();

                return true;
            } else {
                return false;
            }
        }

    }
}
?>