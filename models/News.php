<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $name
 * @property string $anons
 * @property string $text
 * @property string $reg_date
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'anons', 'text'], 'required'],
            [['anons', 'text'], 'string'],
            [['reg_date'], 'safe'],
            [['name'], 'string', 'max' => 255]
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
            'anons' => 'Анонс',
            'text' => 'Текст',
            'reg_date' => 'Дата поста',
        ];
    }
    public function news_list($limit=3){
        $result = $this->find()
            ->orderBy(['reg_date'=>SORT_DESC])
            ->limit($limit)
            ->asArray()
            ->all();
        foreach ($result as $key => $value) {
            echo '
             <article>
                <header>
                    <p class="text-right PT"><a href="/site/view_news?id='.$value['id'].'">'.$value['name'].'</a></p>
                    <p class="text-justify news_text">'.$value['anons'].'</p>
                    <p class="news_date pull-right">'.date("d.m.Y",strtotime($value['reg_date'])).'</p>
                    <div class="clearfix"></div>
                </header>
                <footer>
                    <p class="text-right podrobnee"><a  href="/site/view_news?id='.$value['id'].'" class="btn btn-default">Подробнее</a></p>
                </footer>
            </article>
            ';
        }

    }
}
