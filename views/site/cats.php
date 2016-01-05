<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
$url = parse_url(Yii::$app->request->url);
$url  = explode('/',$url['path']);
$this->title = 'My Yii Application';
$link='/catalog';
foreach ($kroshka['cats'] as $key => $value) {
    if ($key!=count($kroshka['cats'])-1){
        foreach ($url as $key1 => $value1) {
            if (!empty($value1) && $value1!='catalog' ){
                if ($value1==strtolower($value->url)){
                    $link = $link.'/'.$value1;
                    break;
                }else{
                    $link = $link.'/'.$value1;
                }
            }
        }

        $this->params['breadcrumbs'][] = [
            'url'=>$link,
            'label'=>$value->name
        ];
        $link='/catalog';
    }else{
        $this->params['breadcrumbs'][]=$value->name;
    }

}

?>
<div class="container">
    <div class="col-md-9">
    <div class="row">

        <?php

        foreach ($data as $key => $value) {
            echo '
        <div class="col-md-3 product_item">
            <a href="'.Yii::$app->request->url.'/'.strtolower($value['url']).'">
            <div class="product">
                <header>
                     <img class="'.(empty($value->image) ? 'noimage' : 'yesimage').'" src="'.(empty($value->image) ? '/img/no_image_available.svg' : '/img/cats_images/'.'/'.$value['id'].'/'.$value['image']).'">
                </header>
                <footer>
                    <p class="text-center">'.$value['name'].'</p>
                </footer>
            </div>
            </a>

         </div>
        ';
        }
        ?>
    </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title ">Новости</h3>
            </div>
            <div class="panel-body">
                <?php
                $model = new \app\models\News();
                $model->news_list(5);
                ?>

            </div>
        </div>
    </div>


</div>
