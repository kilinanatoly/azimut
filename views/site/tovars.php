<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
$this->params['breadcrumbs'][]='asd'
?>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="row">
            <?php
            foreach ($data as $key => $value) {
                echo '
                <div class="col-md-3">
                    <div class="tovar">
                        <header>
                            <img class="img-responsive" src="'.(empty($value->image) ? '/img/no_image_available.svg' : '/img/products/'.$value->image).'">
                        </header>
                        <footer>
                            <p>'.$value->name.'</p>
                        </footer>
                    </div>
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
                    <article>
                        <header>
                            <p class="text-right PT"><a href="#"> Название новости</a></p>
                            <p class="text-justify news_text">Рыбным текстом называется текст, служащий для временного наполнения макета в публикациях или производстве веб-сайтов, пока финальный текст еще не создан.</p>
                            <p class="news_date pull-right">11.11.2015</p>
                            <div class="clearfix"></div>
                        </header>
                        <footer>
                            <p class="text-right podrobnee"><a  class="btn btn-default">Подробнее</a></p>
                        </footer>
                    </article>

                    <article>
                        <header>
                            <p class="text-right PT"><a href="#"> Название новости</a></p>
                            <p class="text-justify news_text">Рыбным текстом называется текст, служащий для временного наполнения макета в публикациях или производстве веб-сайтов, пока финальный текст еще не создан.</p>
                            <p class="news_date pull-right">11.11.2015</p>
                            <div class="clearfix"></div>
                        </header>
                        <footer>
                            <p class="text-right podrobnee"><a  class="btn btn-default">Подробнее</a></p>
                        </footer>
                    </article>

                    <article>
                        <header>
                            <p class="text-right PT"><a href="#"> Название новости</a></p>
                            <p class="text-justify news_text">Рыбным текстом называется текст, служащий для временного наполнения макета в публикациях или производстве веб-сайтов, пока финальный текст еще не создан.</p>
                            <p class="news_date pull-right">11.11.2015</p>
                            <div class="clearfix"></div>
                        </header>
                        <footer>
                            <p class="text-right podrobnee"><a  class="btn btn-default">Подробнее</a></p>
                        </footer>
                    </article>

                </div>
            </div>
        </div>
    </div>
</div>
