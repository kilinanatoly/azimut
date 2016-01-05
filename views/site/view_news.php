<?php

/* @var $this yii\web\View */
use app\modules\regions\models\Functions;
$this->params['breadcrumbs'][] = [
    'url'=>'/site/news',
    'label'=>'Новости'
];
$this->params['breadcrumbs'][] = $data->name;
?>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <h2><?=$data->name?></h2>
            <p class="posting-date"><b>Дата:</b> <?=Date("d.m.Y",strtotime($data->reg_date))?></p>
            <?=$data->text?>
            <div class="clearfix"></div>
            <p class="text-right"><a href="/site/news" class="btn btn-default main-btn">Вернуться к списку новостей</a></p>
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
</div>
