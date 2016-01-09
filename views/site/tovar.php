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
                <div class="rasp">
                    <p class="text-right">
                        <!-- Web2PDF Converter Button BEGIN -->
                        <script type="text/javascript">
                            var
                                pdfbuttonstyle="custimg"
                            custimg="/img/pdf.jpg"
                        </script>
                        <script src="http://www.web2pdfconvert.com/pdfbutton2.js" id="Web2PDF" type="text/javascript"></script>
                        <!-- Web2PDF Converter Button END -->

                        <a href='javascript:window.print(); void 0;' title="Распечатать страницу"> <img src="/img/pechat.png" / ></a>

                    </p>
                </div>

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
                    <a href="#" data-toggle="modal" data-target="#zapros_price_modal" class="btn btn-default">Запрос коммерческого <br> предложения</a>
                    <a href="#" data-toggle="modal" data-target="#buy_modal" class="btn btn-default">Запросить <br>  счет на оплату</a>
                    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#call_me_modal">Запросить <br>договор поставки</a>
                </div>
            </div>
            <div class="margin5"></div>
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-tabs2">
                        <li class="active"><a href="#opisanie" data-toggle="tab">Описание</a></li>
                        <li><a href="#otzyvy" data-toggle="tab">Отзывы</a></li>
                        <li><a href="#pohozhie" data-toggle="tab">Похожие товары</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="opisanie">
                            <div class="panel panel-default description_panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Описание товара</h3>
                                </div>
                                <div class="panel-body">
                                    <?=$data->description?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="otzyvy">
                            <h2>Отзывы к товару <?=$data->name?></h2>
                            <?php
                            if (!$comments){
                                echo '
                                <div class="bs-callout bs-callout-info">
                                    <h4>Комментариев нет:(</h4>
                                    <p>Вы можете  <a class="first_comment" href="#">стать первым!</a></p>
                                </div>
                                ';
                            }else{
                                foreach ($comments as $key=>$value  ) {
                                    echo '
                                        <div class="media comments_media">
                                                <img class="pull-left" src="/img/talk.png" alt="Автор">
                                            <div class="media-body">
                                                <h4 class="media-heading">'.$value['name'].'</h4>
                                                <p> - '.$value['comment'].'</p>
                                            </div>
                                        </div>
                                    ';

                                }

                            }
                            ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="margin5"></div>
                                    <h3>Добаавить отзыв</h3>
                                    <form role="form" class="add_comment_form">
                                        <input type="hidden" id="commentProductid" value="<?=$data->id?>">
                                        <div class="form-group">
                                            <label for="commentName">Имя</label>
                                            <input type="text" class="form-control" id="commentName" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="commentEmail">Email</label>
                                            <input type="email" class="form-control" id="commentEmail" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="commentComment">Сообщение</label>
                                            <textarea class="form-control" id="commentComment" required></textarea>
                                        </div>
                                        <p class="success-text"></p>
                                        <button type="submit" class="btn btn-default">Отправить</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="pohozhie">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2>Похожие товары</h2>
                                </div>
                                <?php
                                if ($pohozhie){
                                    $functions = new Functions();
                                    foreach ($pohozhie as $key => $value) {
                                        $url = $functions->get_tovar_url($value['id']);

                                        echo '
                                            <div class="col-md-3">
                                            <a href="'.$url.'"><div class="tovar">
                                                    <header>
                                                        <img class="'.(empty($value['image']) ? 'noimage' : 'yesimage').'" src="'.(empty($value['image']) ? '/img/no_image_available.svg' : '/img/products/'.$value['image']).'">
                                                    </header>
                                                    <footer>
                                                        <div class="product_title">
                                                              <p>'.$value['name'].'</p>
                                                        </div>
                                                         <div class="product_price">
                                                              <p><b>Цена:</b> <span class="pull-right">'.($value['price']==0 ? " По запросу" : $value['price'].' руб.').'</span></p>
                                                         </div>
                                                    </footer>
                                                </div>
                                                </a>

                                            </div>
                                            ';
                                    }

                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default panel3 ">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 class="panel-title ">Виды доставки</h3>
                        </div>
                        <div class="col-md-4">
                            <img src="/img/logistics2.png" alt="Логистика" class="img-responsive pull-right">
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                    <div class="panel-group delivery-panel-group" id="accordion">
                        <div class="panel panel-default">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                            Самовывоз Набережные Челны
                                    </h4>
                                </div>
                            </a>

                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                            Доставка по всей России
                                    </h4>
                                </div>
                            </a>

                            <div id="collapseTwo" class="panel-collapse collapse ">
                                <div class="panel-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!--Модальное окно Запросить договор поставки-->
<!-- Modal -->
<div class="modal fade" id="call_me_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Запросить договор поставки на товар <?=$data->name?> . Оставьте свои данные и мы свяжемся с Вами</h4>
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
                    <div class="form-group">
                        <label for="inn1">ИНН</label>
                        <input type="text" class="form-control" id="inn1" required>
                    </div>
                    <div class="form-group">
                        <label for="gorod1">Город поставки товара</label>
                        <input type="text" class="form-control" id="gorod1" required>
                    </div>
                    <div class="form-group">
                        <label for="comment1">Комментарий</label>
                        <input type="text" class="form-control" id="comment1" >
                    </div>
                    <p class="error-text"></p>
                    <p class="success-text"></p>
                    <p class="text-right"><button type="submit" class="btn btn-default">Запросить</button></p>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Модальное окно Запрос коммерческого предложения-->
<!-- Modal -->
<div class="modal fade" id="zapros_price_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Запрос коммерческого предложения на товар <?=$data->name?>. Оставьте свои данные и мы свяжемся с Вами</h4>
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
                    <div class="form-group">
                        <label for="inn2">ИНН</label>
                        <input type="text" class="form-control" id="inn2" required>
                    </div>
                    <div class="form-group">
                        <label for="gorod2">Город поставки товара</label>
                        <input type="text" class="form-control" id="gorod2" required>
                    </div>
                    <div class="form-group">
                        <label for="comment2">Комментарий</label>
                        <input type="text" class="form-control" id="comment2" >
                    </div>
                    <p class="error-text"></p>
                    <p class="success-text"></p>
                    <p class="text-right"><button type="submit" class="btn btn-default">Запросить счет на оплату</button></p>
                </form>
            </div>
        </div>
    </div>
</div>