<?php

/* @var $this yii\web\View */
use app\modules\regions\models\Functions;
use yii\widgets\ActiveForm;

$url = parse_url(Yii::$app->request->url);
$url  = explode('/',$url['path']);
$this->title = 'My Yii Application';
$link='/catalog';
foreach ($kroshka['cats'] as $key => $value) {
    if ($key!=count($kroshka['cats'])-1){
        foreach ($url as $key1 => $value1) {
            if (!empty($value1) && $value1!='catalog' ){
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
    }else{
        $this->params['breadcrumbs'][]=$value->name;
    }

}
$functions = new Functions();

?>

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="row">
            <div class="col-md-12">
                <p class="pull-left" style="padding-top:6px;">Вид отображения</p>
                <div class="btn-group vid">
                    <a href="?view=1" class="btn btn-default"><span class="glyphicon glyphicon-th"></span></a>
                    <a href="?view=2" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span></a>
                </div>
            </div>
            <?php
            if (isset($_GET['view']) && $_GET['view']==2){
               echo'
               <table class="table table-striped">
                  <thead>
                    <tr>
                    <th>Название</th>
                    ';
                foreach ($chars as $key => $value) {
                    echo '<th>'.$value['char_name'].'</th>';
                }
                echo '<th>Стоимость</th>';
                echo'
                    </tr>
                  </thead>
                  <tbody>
                  ';
                foreach ($data as $key => $value) {
                    $url = $functions->current_url().'/'.strtolower($functions->translit($value['name'])).'-'.$value['id'];
                    echo '<tr>';
                    echo '<td><a href="'.$url.'">'.$value['name'].'</a></td>';
                    foreach ($value['chars'] as $key1 => $value1) {
                        echo '<td>'.($value1['value']=='none' ? 'Не указано' : $value1['value']).'</td>';
                    }
                    echo ($value['price']==0 ? '<td><b>По запросу</b></td>' : '<td>'.$value['price'].'</td>');
                    echo '</tr>';
                }
                    echo '
                  </tbody>
                </table>
               ';
            }else{
                foreach ($data as $key => $value) {
                    $url = $functions->current_url().'/'.strtolower($functions->translit($value['name'])).'-'.$value['id'];
                    echo '
                <div class="col-md-3">
                <a href="'.$url.'"><div class="tovar">
                        <header>
                            <img class="'.(empty($value->image) ? 'noimage' : 'yesimage').'" src="'.(empty($value->image) ? '/img/no_image_available.svg' : '/img/products/'.$value->image).'">
                        </header>
                        <footer>
                            <div class="product_title">
                                  <p>'.$value->name.'</p>
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
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title ">Фильтр</h3>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(); ?>
                        <?php
                        foreach ($chars as $key => $value) {
                            echo '<p>'.$value['char_name'].'</p>';
                            if ($value['chars']['type']=='string'){
                                echo '
                            <div class="form-group">
                                <select name="sel'.$value['character_id'].'" class="form-control">';
                                for ($i=0;$i<count($value['chars'])-1;$i++){
                                    echo '<option value="'.$value['chars'][$i].'">'.$value['chars'][$i].'</option>';
                                }
                                echo '</select>
                            </div>
                        ';
                            }elseif ($value['chars']['type']=='number'){
                            }
                        }
                        ?>
                        <p class="text-center"><button type="submit"  class="btn btn-default main-btn">Подобрать</button></p>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
