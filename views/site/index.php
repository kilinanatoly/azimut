<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <div class="your-class">
                        <div><p class="text_slider">asd</p><img class="img-responsive" src="/img/1.jpg" alt=""></div>
                        <div><img class="img-responsive" src="/img/3.jpg" alt=""></div>
                        <div><img class="img-responsive" src="/img/2.jpg" alt=""></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2>Почему именно мы</h2>
                    <hr>
                    <p>Компания «Азимут» начала свою работу в 2009 г. За этот короткий период благодаря высокому профессионализму молодых и энергичных сотрудников наша компания выросла до ключевого игрока рынка строительного и промышленного оборудования Закамского региона.</p>
                    <p>
                        На все поставляемое оборудование ООО ПКФ «Азимут» предоставляет гарантию завода-изготовителя, что позволяет осуществлять ремонт в кратчайшие сроки на территории Заказчика или в собственном сервисном центре.</p>
                    <p>
                        Основная цель – эффективное решение задач, поставленных заказчиком.
                        Ассортимент предлагаемого промышленного и строительного оборудования отличается высоким качеством и надежностью в эксплуатации. Это обусловлено сотрудничеством с ведущими отечественными и зарубежными производителями.
                        Подробнее</p>
                    <h2>Каталоги продукции</h2>
                    <hr>
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
</div>
