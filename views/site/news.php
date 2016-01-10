<?php

/* @var $this yii\web\View */
use app\modules\regions\models\Functions;

$this->params['breadcrumbs'][] = 'Новости';
$this->title = "Список новостей";
?>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <?php
            foreach ($data as $key => $value) {
                echo '
                    <div class="panel panel-default newspanel">
                        <div class="panel-heading">
                            <h3 class="panel-title ">'.$value['name'].'</h3>
                        </div>
                        <div class="panel-body">
                            <p>'.$value['anons'].'</p>
                            <p class="pull-right">'.date("d.m.Y",strtotime($value['reg_date'])).'</p>
                            <div class="clearfix"></div>
                            <p class="text-right podrobnee"><a  href="/site/view_news?id='.$value['id'].'" class="btn btn-default">Подробнее</a></p>
                        </div>
                    </div>
                ';
            }

            ?>


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
