<?php
namespace app\modules\arenda\models;
use yii\base\Model;
use yii\web\UploadedFile;
use Yii;
use yii\imagine\Image;

use \Imagine\Image\Box;
use \Imagine\Image\Point;

class UploadFile extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 10,'checkExtensionByMimeType'=>false],
        ];
    }

    public function upload($id)
    {
        if ($this->validate()) {
            mkdir("../web/images/arenda/".$id, 0777);

            foreach ($this->imageFiles as $file) {
                $filename = md5($file->baseName.date('Ymdhis'));
                $imagine = new \Imagine\Gd\Imagine();
                $watermark = $imagine->open('../web/images/arenda/water.png ');
                $image     = $imagine->open($file->tempName);
                $size      = $image->getSize();
                $wSize     = $watermark->getSize();

                $bottomRight = new \Imagine\Image\Point($size->getWidth() - $wSize->getWidth(), $size->getHeight() - $wSize->getHeight());



                $image->paste($watermark, $bottomRight)->save('../web/images/arenda/'.$id.'/'. $filename . '.'.$file->extension);

                $model = new ImagesForAds();
                $model->ad_id = $id;
                $model->image_url = $filename.'.'.$file->extension;
                $model->save();
            }
            return true;
        } else {
            return false;
        }
    }
}