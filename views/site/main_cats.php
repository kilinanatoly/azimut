<?php

/* @var $this yii\web\View */

$this->title = 'Каталог продукции';
$this->params['breadcrumbs'][]='Каталог';

?>
<div class="container">
    <div class="col-md-9">
        <div class="row index-catalog">
            <div class="col-md-4">
                <h3 class="text-center"><a href="/catalog/zapchasti">Запчасти</a></h3>
                <a href="/catalog/zapchasti"><img class="img-responsive" src="/img/gear.png" alt="Запчасти"></a>
            </div>
            <div class="col-md-4">
                <h3 class="text-center"><a href="/catalog/akb">Аккумуляторы АКБ</a></h3>
                <a href="/catalog/akb"><img class="img-responsive battery-img" src="/img/batteries.png" alt="АКБ"></a>
            </div>
            <div class="col-md-4">
                <h3 class="text-center"><a href="/catalog/shiny">Шины</a></h3>
                <a href="/catalog/shiny"><img class="img-responsive" src="/img/tire.png" alt="Шины"></a>
            </div>
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
