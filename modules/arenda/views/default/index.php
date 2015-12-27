<?php
use app\modules\arenda\assets\arendaAsset;
arendaAsset::register($this);
$this->title = "Список объявлений";
?>
<style>
    #map {
        width: 100%; height: 200px; padding: 0; margin: 0;
    }
</style>

<div class="col-md-6 ads_wrap">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="btn-group">
                    <a href="./arenda" type="button" class="btn btn-default">Все</a>
                    <a href="?user=1" type="button" class="btn btn-default">Частные</a>
                    <a href="?user=2" type="button" class="btn btn-default">Компании</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="btn-group pull-right">
                    <a href="#" type="button" class="btn btn-default"><span class="glyphicon glyphicon-align-left"></span></a>
                    <a href="#"  type="button" class="btn btn-default"><span class="glyphicon glyphicon-align-center"></span></a>
                    <a href="#" type="button" class="btn btn-default"><span class="glyphicon glyphicon-align-right"></span></a>
                    <a href="#" type="button" class="btn btn-default"><span class="glyphicon glyphicon-align-justify"></span></a>
                </div>
            </div>

        </div>
    </div>

<?php
//Выводим объявления
if ($data){
    foreach ($data as $key=>$value){
        //разбираемся с датой
        $now_day = Date('d');
        $ad_day = date("d",strtotime($value['reg_date']));
        if ($value['arenda_price_km']!=-1) $km = ','.$value['arenda_price_km'].' руб./км';
        else $km = '';
        echo '

     <div class="row row_ad">
        <div class="col-md-12 ad_div">
            <div class="col-md-4 ad_image_div">

                <img src="'.(!empty($value['main_image']) ? '/images/arenda/'.$value['id'].'/'.$value['main_image'] : '/images/site_images/no-thumb.png').'">
            </div>

            <div class="col-md-8 ad_info_div">
                     <p><a href="arenda/default/view_ad?id='.$value['id'].'"> '.$value['name'].'</a></p>
                     <p>'.$value['arenda_price_hour'].' руб./час,'.$value['arenda_price_day'].' руб./день  '.$km.'</p>
                     <p>Категория: '.$value['catname'][0][1].' / '.($value['person'] == 'person_ch' ? 'Частное лицо' : 'Компания').'</p>
                     <p>'.$value['city_name'].'</p>
                     <p>Дата: '.($now_day==$ad_day ? 'Сегодня' : date("d-m-Y",strtotime($value['reg_date']))).' в '.date("H:i",strtotime($value['reg_date'])).' </p>
            </div>
        </div>
    </div>

        ';
    }
}else{
    echo '
    <div class="row">
        <div class="col-md-12">
            <p>Ничего не найдено.</p>
        </div>
    </div>
    ';
}
?>

</div>
