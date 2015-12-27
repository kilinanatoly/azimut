<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="container-fluid">
    <div class="row">
        <nav role="navigation" class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header header">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <img src="img/azimut-logo.png" class="img-responsive" alt="Логотип">
                            </div>
                        </div>
                    </div>

                    <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div id="navbarCollapse" class="collapse navbar-collapse navbar-right">
                    <ul class="nav nav-pills">
                        <li class="active"> <a href="#">Главная</a> </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Запчасти <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Действие</a></li>
                                <li><a href="#">Другое действие</a></li>
                                <li><a href="#">Что-то еще</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Отдельная ссылка</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Еще одна отдельная ссылка</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Аккумуляторы АКБ <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Действие</a></li>
                                <li><a href="#">Другое действие</a></li>
                                <li><a href="#">Что-то еще</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Отдельная ссылка</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Еще одна отдельная ссылка</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Шины <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Действие</a></li>
                                <li><a href="#">Другое действие</a></li>
                                <li><a href="#">Что-то еще</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Отдельная ссылка</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Еще одна отдельная ссылка</a></li>
                            </ul>
                        </li>
                        <li> <a href="#">Контакты</a> </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

<hr>


<div class="wrapper">
    <?=$content?>
    <div class="margin8"></div>
    <div class="container-fluid special-buy-container">
        <div class="row">
            <h2 class="text-center">Успей купить!</h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="hui">
                <div class="col-md-2">
                    <img class="img-responsive" src="img/bat.png" alt="">
                    <p class="text-center"><a href="#">Аккумулятор STRONG</a></p>
                </div>

                <div class="col-md-2">
                    <img class="img-responsive" src="img/bat.png" alt="">
                    <p class="text-center"><a href="#">Аккумулятор STRONG</a></p>
                </div>

                <div class="col-md-2">
                    <img class="img-responsive" src="img/bat.png" alt="">
                    <p class="text-center"><a href="#">Аккумулятор STRONG</a></p>
                </div>

                <div class="col-md-2">
                    <img class="img-responsive" src="img/bat.png" alt="">
                    <p class="text-center"><a href="#">Аккумулятор STRONG</a></p>
                </div>

                <div class="col-md-2">
                    <img class="img-responsive" src="img/bat.png" alt="">
                    <p class="text-center"><a href="#">Аккумулятор STRONG</a></p>
                </div>

                <div class="col-md-2">
                    <img class="img-responsive" src="img/bat.png" alt="">
                    <p class="text-center"><a href="#">Аккумулятор STRONG</a></p>
                </div>

                <div class="col-md-2">
                    <img class="img-responsive" src="img/bat.png" alt="">
                    <p class="text-center"><a href="#">Аккумулятор STRONG</a></p>
                </div>

                <div class="col-md-2">
                    <img class="img-responsive" src="img/bat.png" alt="">
                    <p class="text-center"><a href="#">Аккумулятор STRONG</a></p>
                </div>


            </div>
        </div>
    </div>

    <hr>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Напишите нам</h2>
                <div class="line"></div>
                <form role="form" class="send_form1">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Имя</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputText1">Сообщение</label>
                        <textarea class="form-control" id="exampleInputText1" ></textarea>
                    </div>


                    <a class="btn btn-default">Отправить</a>
                </form>

            </div>
            <div class="col-md-6 contacts">
                <h2>Наши контакты</h2>
                <div class="line"></div>
                <div class="row">
                    <div class="col-md-1"><img class="img-responsive" src="img/phone.png" alt="Телефон"></div>
                    <div class="col-md-11">
                        <p><b>Телефон:</b></p>
                        <p><a href="#">8(960)-085-41-39</a></p>
                    </div>

                    <div class="clearfix"></div>
                    <div class="margin3"></div>

                    <div class="col-md-1"><img class="img-responsive" src="img/email.png" alt="Email"></div>
                    <div class="col-md-11">
                        <p><b>EMAIL:</b></p>
                        <p><a href="#">azimut@ya.ru</a></p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="margin3"></div>

                    <div class="col-md-1"><img class="img-responsive" src="img/home.png" alt="Адрес"></div>
                    <div class="col-md-11">
                        <p><b>Адрес:</b></p>
                        <p>1 автодорога, поворот на БСИ</p>
                    </div>

                    <div class="clearfix"></div>
                    <div class="margin3"></div>

                    <div class="col-md-1"><img class="img-responsive" src="img/twitter.png" alt="twitter"></div>
                    <div class="col-md-11">
                        <p><b>Twitter:</b></p>
                        <p><a href="#">Azimut</a></p>
                    </div>



                </div>
            </div>
        </div>
    </div>
    <hr class="hr_no_margin">


</div>

<footer>
    <div class="container-fluid">
        <div class="row ">
            <div class="container ">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="footer_menu">
                            <li><a href="#">Главная</a></li>
                            <li><a href="#">Запчасти</a></li>
                            <li><a href="#">Аккумуляторы АКБ</a> </li>
                            <li><a href="#">Шины</a></li>
                            <li><a href="#">Контакты</a></li>
                        </ul>
                        <p class="text-center">&copy2015 AZIMUT LTD</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
