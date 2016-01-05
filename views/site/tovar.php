<?php

/* @var $this yii\web\View */
use app\modules\regions\models\Functions;
$url = parse_url(Yii::$app->request->url);
$url  = explode('/',$url['path']);
$this->title = 'My Yii Application';
$link='/catalog';
foreach ($kroshka['cats'] as $key => $value) {
    foreach ($url as $key1 => $value1) {
        if (!empty($value1) && $value1!='catalog'){
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
}
$this->params['breadcrumbs'][] = $kroshka['tovars'][0]->name;

?>
<div class="container">
    <div class="row">
        <div class="col-md-9 view_tovar">
            <?php
                echo '<h2>'.$data['name'].'</h2>';
            ?>
            <div class="row row1">
                <div class="col-md-4">
                    <img class="img-responsive" src="<?=(empty($data->image) ? '/img/no_image_available.svg' : '/img/products/'.$data->image)  ?>" alt="<?= $data->name ?>">
                </div>
                <div class="col-md-8">
                    <h3>Технические характеристики:</h3>

                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Значение</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php

                        $flag=0;
                        foreach ($characteristics as $key => $value) {
                            if ($value['value']=='none') continue;
                            echo '<tr>';
                            echo '<td>'.$value['characteristic_name'].'</td>';
                            echo '<td>'.$value['value'].'</td>';
                            echo '<tr>';
                            $flag=1;
                        }
                        if (empty($characteristics) || $flag!=1){
                            echo '<tr style="text-align:center;">';
                            echo '<td colspan="2">Нет данных</td>';
                            echo '</tr>';
                        }

                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row row2">
                <div class="col-md-4 tovar_price">
                    <p>Цена: <?=(empty($data->price) ? 'По запросу' : $data->price.' руб.')?></p>
                </div>
                <div class="col-md-8 tovar_buttons">
                    <?=(empty($data->price) ? '<a href="#" data-toggle="modal" data-target="#zapros_price_modal" class="btn btn-default">Запросить стоимость</a>' : '<a href="#" data-toggle="modal" data-target="#buy_modal" class="btn btn-default">Купить</a>')?>
                    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#call_me_modal">Перезвоните мне</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default description_panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Описание товара</h3>
                        </div>
                        <div class="panel-body">
                            <?=$data->description?>
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

<!--Модальное окно перезвоните мне-->
<!-- Modal -->
<div class="modal fade" id="call_me_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">У вас остались вопросы по товару <?=$data->name?> ? Оставьте свои данные и мы свяжемся с Вами</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="send_form2">
                    <input type="hidden" value="<?=$data->id?>" id="product_id1">
                    <div class="form-group">
                        <label for="name1">Имя</label>
                        <input type="text" class="form-control" id="name1" required>
                    </div>
                    <div class="form-group">
                        <label for="email1">Email</label>
                        <input type="email" class="form-control" id="email1" >
                    </div>
                    <div class="form-group">
                        <label for="tel1">Телефон</label>
                        <input type="text" class="form-control" id="tel1" >
                    </div>
                    <p class="error-text"></p>
                    <p class="success-text"></p>
                    <p class="text-right"><button type="submit" class="btn btn-default">Свяжитесь со мной</button></p>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Модальное окно Запрос стоимости-->
<!-- Modal -->
<div class="modal fade" id="zapros_price_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Запрос стоимости товара <?=$data->name?>. Оставьте свои данные и мы свяжемся с Вами</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="send_form4">
                    <input type="hidden" value="<?=$data->id?>" id="product_id3">
                    <div class="form-group">
                        <label for="name3">Имя</label>
                        <input type="text" class="form-control" id="name3" required>
                    </div>
                    <div class="form-group">
                        <label for="email3">Email</label>
                        <input type="email" class="form-control" id="email3" >
                    </div>
                    <div class="form-group">
                        <label for="tel3">Телефон</label>
                        <input type="text" class="form-control" id="tel3" >
                    </div>
                    <p class="error-text"></p>
                    <p class="success-text"></p>
                    <p class="text-right"><button type="submit" class="btn btn-default">Запросить стоимость</button></p>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Модальное окно Запрос счета на оплату-->
<!-- Modal -->
<div class="modal fade" id="buy_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Запрос счета на оплату товара <?=$data->name?>. Оставьте свои данные и мы свяжемся с Вами</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="send_form3">
                    <input type="hidden" value="<?=$data->id?>" id="product_id2">
                    <div class="form-group">
                        <label for="name2">Имя</label>
                        <input type="text" class="form-control" id="name2" required>
                    </div>
                    <div class="form-group">
                        <label for="email2">Email</label>
                        <input type="email" class="form-control" id="email2" >
                    </div>
                    <div class="form-group">
                        <label for="tel2">Телефон</label>
                        <input type="text" class="form-control" id="tel2" >
                    </div>
                    <p class="error-text"></p>
                    <p class="success-text"></p>
                    <p class="text-right"><button type="submit" class="btn btn-default">Запросить счет на оплату</button></p>
                </form>
            </div>
        </div>
    </div>
</div>