<?php

/* @var $this yii\web\View */
$this->title = $data['name'];
//разбираемся с датой
$now_day = Date('d');
$ad_day = date("d",strtotime($data['reg_date']));
if ($data['arenda_price_km']!=-1) $km = ','.$data['arenda_price_km'].' руб./км';
else $km = '';
?>
<div class="row">
   <h2><?=$data['name']?></h2>

    <div class="col-md-6">
        <div class="row">
            <?php
            echo '<p>Размещено: '.($now_day==$ad_day ? 'Сегодня' : date("d-m-Y",strtotime($data['reg_date']))).' в '.date("H:i",strtotime($data['reg_date'])).' </p>
            ';
            ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 ad_photos_block">
        <div class="row">
            <?php
            if (empty($photos)) echo'<p><b>Фотографий нет</b></p>';
            foreach ($photos as $key=>$value) {

                echo '<div class="col-md-4 ad-image">
                          <a class="fancyimage" data-fancybox-group="group" href="/images/arenda/'.$data['id'].'/'.$value['image_url'].'">
                             <img  class="img-responsive" src="/images/arenda/'.$data['id'].'/'.$value['image_url'].'">
                          </a>
                    </div>';
            }

            ?>
        </div>
    </div>
</div>
<div class="margin5"></div>
<div class="row">
    <div class="col-md-6">
        <div class="row">
            <p>Тип объявления: <b><?=($data['ad_type']=='spros' ? 'Спрос' : 'Предложение')?> </b></p>
            <p>Принадлежность: <b><?=($data['person']=='person_ch' ? 'Частное лицо' : 'Компания')?> </b></p>
            <?php
            echo '<p>Стоимость : <b>'.$data['arenda_price_hour'].' руб./час</b>,<b>'.$data['arenda_price_day'].' руб./день </b> <b>'.$km.'</b></p>';
            echo '<p>Минимальный срок аренды в сутках : <b>'.$data['min_arenda_days'].'</b>  </p>';
            echo '<p>Минимальный срок аренды в часах : <b>'.$data['min_arenda_hours'].'</b>  </p>';
            ?>
            <hr>
            <p>Город:<b> <?=$data['city_name']?> </b></p>
            <p>Описание объявления: <?=$data['comment']?> </p>
            <p>Оплата наличными: <b><?=($data['oplata_nal']!='none' ? 'Да' : 'Нет')?> </b></p>
            <p>Безналичный расчет: <b><?=($data['oplata_beznal']!='none' ? 'Да' : 'Нет')?></b> </p>
            <p class="gray">Номер объявления: <?=$data['id']?> </p>
        </div>
    </div>
</div>




