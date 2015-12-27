<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\modules\Tree\assets\TreeAsset;
TreeAsset::register($this);

$this->title = (!empty($parent) ? 'Добавление подкатегории в категорию '.$parent->name : 'Добавить категорию');
$this->params['breadcrumbs'][] = ['label' => 'Технические характеристики', 'url' => ['charact']];
$this->params['breadcrumbs'][] = ['label' => $par->name , 'url' => ['viewcharact?id='.$par->id]];
$this->params['breadcrumbs'][] = 'Данная "'.$data->name.'"';
$session = Yii::$app->session;
echo $session->getFlash('ch_data_isp');
?>
<h2>Использование данной <?=$data->name?></h2>
<?php $form = ActiveForm::begin(); ?>
<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary','style'=>'margin-top:10px;']) ?>
</div>
<div class="form-group">
    <?= Html::a('Вернуться к характеристике', ['/tree/admin/viewcharact','id'=>$data->parent_id], ['class' => 'btn btn-default']) ?>
</div>

<?php

    echo '
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron cats_jumbotron">
                '.$tree.'
            </div>
        </div>
    </div>
    ';
?>
<div class="form-group">
    <input type="hidden" name="data_id" value="<?=$data->id?>"/>
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary','style'=>'margin-top:10px;']) ?>
</div>
<?php ActiveForm::end(); ?>
<?= Html::a('Вернуться к характеристике', ['/tree/admin/viewcharact','id'=>$data->parent_id], ['class' => 'btn btn-default']) ?>









