<?php
@session_start();
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form ActiveForm */
$this->title = 'Добавление товара в категорию "'.$parent->name.'"';
$this->params['breadcrumbs'][] = ['label'=>$_SESSION['cat_r'],'url'=>$_SESSION['cat']] ;
$this->params['breadcrumbs'][] = $this->title ;
?>
<div class="products-create">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput()->label('Название') ?>
        <?= $form->field($model, 'description')->textarea()->label('Описание продукта') ?>
        <?= $form->field($model, 'price')->textInput()->label('Цена (0 - по запросу)') ?>
        <?= $form->field($model, 'active')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
        </div>
    <div class="form-group">
        <a  class="btn btn-default" href="/products/<?=$_SESSION['cat']?>">Вернуться к списку</a>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- products-create -->
