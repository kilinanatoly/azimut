<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
use yii\widgets\Breadcrumbs;

?>
<div class="container">
    <div class="col-md-9">
    <div class="row">

        <?php
        $this->params['breadcrumbs'][] = ['label' => 'Весь список категорий', 'url' => ['index']];

        foreach ($data as $key => $value) {
            echo '
        <div class="col-md-3 product_item">
            <a href="'.Yii::$app->request->url.'/'.strtolower($value['url']).'">
            <div class="product">
                <header>
                    <img class="img-responsive" src="/img/cats_images/'.$value['id'].'/'.$value['image'].'" alt="">
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

    </div>


</div>
