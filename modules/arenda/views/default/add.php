<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\modules\arenda\assets\arendaAsset;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;

arendaAsset::register($this);
@session_start();
?>
<div class="row">
    <div class="col-md-12 steps">
        <div class="row">
            <div class="col-md-3 step_1 ">
                <div class="row step_row">
                    <div class="col-md-11 active_step"> Основные данные</div>
                    <div class="col-md-1 treug"></div>
                </div>
            </div>

            <div class="col-md-3 step_2 ">
                <div class="row step_row">
                    <div class="col-md-11 no_active_step"> Основные данные</div>
                    <div class="col-md-1 treug_gr"></div>
                </div>
            </div>

            <div class="col-md-3 step_3 ">
                <div class="row step_row">
                    <div class="col-md-11 no_active_step"> Основные данные</div>
                    <div class="col-md-1 treug_gr"></div>
                </div>
            </div>

            <div class="col-md-3 step_4 ">
                <div class="row step_row">
                    <div class="col-md-12 no_active_step"> Основные данные</div>
                </div>
            </div>
        </div>
    </div>
</div>
<h3>Добавить объявление</h3>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
<?php
$model3 = \app\modules\arenda\models\GeobaseRegion::find()->asArray()->all();

echo '
<p class="type_a"><span class="span_type">Сдам в аренду: </span>
<span class="cats_bread">
    <span class="first_caat">

    </span>




</span>

 </p>
 <p class="sel_city"><a href="#">Выбрать город:</a></p>



<div class="form-group arenda_view_wrap">
    <div class="row arenda_view">
        <div class="col-md-12" >
            <label><input type="radio" value="predlojenie" name="ad_type" checked>Сдаю в аренду</label>
            <label><input type="radio" value="spros" name="ad_type">Хочу приобрести в аренду</label>
        </div>
    </div>
</div>

<div class="form-group" style="display: none">
    <p><b>Адрес</b></p>
    <div class="row">
        <div class="col-md-12" >
            <input  type="text" class="form-control n_punkt_input" >
            <ul class="cities_select pull-right">
            <div class="n_punkts">
             </div>
             </ul>
        </div>
    </div>
</div>

<div class="form-group city_select_wrap">
    <div class="row city_select">
        <div class="col-md-6" >
            <p class="ad_add_title"> Выберите населенный пункт</p>
           <select class="form-control sel_regions" id="sel_regions"  name="sel_regions" >
            <option disabled >Выберите</option>';
foreach ($regions_and_cities as $key => $value) {
    if ($_SESSION['city']==$value['id'])  ;
    echo '<option value="' . $value['id'] . '"'.($_SESSION['city']==$value['id'] ? ' selected' : '').'>' . $value['name'] . ' ('.$value['GR_name'].')</option>';
}
echo '</select></div>';
?>
</div>
</div>


<div class="clearfix">
</div>
<!--конец первого шага(выбор города и региона-->


<div class="cats1">
    <?php
    echo '
        <div class="row city_select">
            <div class="col-md-12">

                <div class="form-group cats_add"  style="display: none">
                    <p class="ad_add_title"> Выберите категорию</p>
                    <div class="row">
                        ';
                        foreach ($categories as $key => $value) {
                          echo '
                        <div class="col-md-4 main_cat_item" data-id="'.$value['id'].'">
                         <div class="row item_row">
                           <div class="col-md-2 item_img">
                                <img  class="pull-right" src="/images/cats_images/'.$value['id'].'/'.$value['image_url'].'">
                           </div>
                           <div class="col-md-10 item_text">
                                <header>
                                    '.$value['name'].'
                                </header>
                                <footer>';
                                    $childs = \app\modules\Tree\models\ModArendaTree::find()->where(['parent_id'=>$value['id']])->asArray()->all();
                                    if (!empty($childs)){
                                        $text = '<p>';
                                        foreach ($childs as $key1 => $value1) {
                                            $text.=$value1['name'].', ';
                                        }
                                        $text = substr($text, 0, -2);
                                        $text.='</p>';
                                    }else{
                                        $text = 'Нет подкатегорий';
                                    }

                                    echo $text;
                                echo '</footer>
                           </div>
                        </div>
                        </div>

                        ';
                        }
                    echo '</div>';
                    ?>
                    </div>
                </div>

            </div>
    </div>

<div class="row cats_first cats_list" style="display: none">
        <div class="col-md-12 cats_first_list">
            <p class="ad_add_title "> Выберите категорию</p>
            <ul>
                <li>первая</li>
                <li>первая</li>
                <li>первая</li>
                <li>первая</li>
                <li>первая</li>
                <li>первая</li>
            </ul>
        </div>

</div>

<div class="row cats_next cats_list" style="display: none">
    <div class="col-md-12">
        <p class="ad_add_title"> Выберите категорию</p>
    </div>
    <div class="col-md-12 cats_next_list">
        <ul>
            <li>первая</li>
            <li>первая</li>
            <li>первая</li>
            <li>первая</li>
            <li>первая</li>
            <li>первая</li>
        </ul>

    </div>
</div>

<div class="row arenda_type_row" style="display:none" >
    <div class="col-md-12">
        <p class="ad_add_title">Выберите тип аренды</p>
    </div>
    <div class="col-md-2 arenda_type_col">
        <label><input type="checkbox" value="1" name="k"><span></span></label><span class="arenda_type_title">Тип аренды</span>
    </div>
</div>


<div class="form-group ad_name"  style="display: none">
    <p><b>Название объявления</b></p>
    <div class="row">
        <div class="col-md-12" >
            <input  type="text" class="form-control " name="ad_name">
        </div>
    </div>
</div>
<div class="clearfix"></div>
<!--конец второго шага(выбор категорий и подкатегорий-->




<!--КОНЕЦ 1 БЛОКА-->


<div id="step_2_block" style="display: none">
    <div class="form-group arenda_srok">
        <p><b>Минимальный срок аренды в часах:</b></p>
            <div class="row">
                <div class="col-md-1" >
                     <select  class="min_arenda_hours form-control " name="min_arenda_hours"  />
                    <?php
                        for ($i=0;$i<24;$i++){
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                    ?>
                     </select>
                </div>
            </div>
        <p><b>Минимальный срок аренды в сутках:</b></p>
            <div class="row">
                <div class="col-md-1" >
                  <select  class="min_arenda_days form-control " name="min_arenda_days"   />
                    <?php
                    for ($i=1;$i<16;$i++){
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                    ?>
                    </select>
                </div>
            </div>
    </div>

    <div class="form-group">
        <p><b>Минимальная цена аренды в час</b></p>
        <div class="row">
            <div class="col-md-1" >
                <input   type="text"  class="form-control input_numbers" name="arenda_price_hour" required>
            </div>
            <div class="col-md-1" style="padding:0">
                руб.
            </div>
        </div>
        <p><b>Минимальная цена аренды в сутки</b></p>
        <div class="row">
            <div class="col-md-1" >
                <input type="text" class="form-control input_numbers" name="arenda_price_day" required>
            </div>
            <div class="col-md-1" style="padding:0">
                руб.
            </div>
        </div>
    </div>

    <div class="form-group arenda_price_km" display="none">
        <p><b>Цена аренды за 1 км.</b></p>
        <div class="row">
            <div class="col-md-1" >
                <input  type="text" value="-1" class="form-control " name="arenda_price_km" required>
            </div>
            <div class="col-md-1" style="padding:0">
                руб.
            </div>
        </div>
    </div>

    <div class="form-group">
        <p><b>Сумма залога (необязательное поле)</b></p>
        <div class="row">
            <div class="col-md-1" >
                <input type="text" class="form-control input_numbers" name="zalog">
            </div>
            <div class="col-md-1" style="padding:0">
                руб.
            </div>
        </div>
    </div>

    <div class="form-group">
        <p><b>Оплата:</b></p>
        <label >
            <input type="checkbox"  class="min_arenda_hours" name="oplata_nal" checked  /> Наличный расчет
        </label>
        <label >
            <input type="checkbox"  class="min_arenda_days" name="oplata_beznal"   /> Безналичный расчет
        </label>
    </div>
    <div class="form-group">
        <p><b>Дополнительное поле:</b></p>
                <textarea class="form-control" name="comment" ></textarea>
    </div>
    <div class="col-md-offset-4 col-md-4 step_to_3" style="display: none">
        <button type="button" class="btn btn-default next_tab">Перейти к третьему шагу</button>
    </div>
    <div class="clearfix"></div>

</div>
<!--КОНЕЦ 2 БЛОКА-->
<div id="step_3_block" style="display:none">
    <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->label("Выберите файлы, максимум:10") ?>
    <div class="form-group">
        <p><b>Ссылка на видео:</b></p>
        <div class="row">
            <div class="col-md-6" >
                <input type="text" class="form-control" name="video">
            </div>
        </div>
    </div>
</div>
<div class="col-md-offset-4 col-md-4 step_to_4" style="display: none">
    <button type="button" class="btn btn-default next_tab">Перейти к четвертому шагу</button>
</div>

<div class="clearfix"></div>
<!--КОНЕЦ 3 БЛОКА-->
<div id="step_4_block" style="display:none">
    <div class="form-group">
        <p><b>Email для подтверждеия размещения объявления:</b></p>
        <div class="row">
            <div class="col-md-6" >
                <input type="email" class="form-control" name="email" required>
            </div>
        </div>
    </div>

    <div class="form-group">
        <p><b>Принадлежность:</b></p>
        <div class="row">
            <div class="col-md-6" >
                <label>
                    <input type="radio"   name="person" value="person_ch" checked  />Частное лицо
                </label>
                <label >
                    <input type="radio"   name="person" value="person_k" />Компания
                </label>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<?= Html::submitButton('Добавить объявление', ['class' => 'btn btn-primary add_ad','style'=>'display:none']) ?>
<?php ActiveForm::end() ?>
</div>
