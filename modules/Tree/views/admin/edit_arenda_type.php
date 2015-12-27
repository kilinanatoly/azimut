<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\Tree\assets\TreeAsset;
TreeAsset::register($this);
$this->params['breadcrumbs'][] = ['label' => 'Типы аренды', 'url' => ['arendatypes']];
$this->params['breadcrumbs'][] = 'Редактирование типа аренды "'.$model->name.'"';
/* @var $this yii\web\View */
/* @var $model app\modules\regions\models\ModArendaRegions */
/* @var $form ActiveForm */
$session = Yii::$app->session;
echo $session->getFlash('edit');
?>
<div class="site-edit">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <div class="form-group">
        <?= Html::a('Вернуться к списку', ['/tree/admin/arendatypes'], ['class' => 'btn btn-default']) ?>
    </div>
    <?= $form->field($model_upload, 'imageFile')->fileInput()->label('Иконка') ?>
    <?php
    if (!empty($icon))
    {
        echo '<img src="/images/arenda_types_images/'.$icon->arenda_type_id.'/'.$icon->url.'">';
    }

    ?>

    <?= $form->field($model_upload, 'imageFile1')->fileInput()->label('Иконка ( черная при наведении )') ?>
    <?php
    if (!empty($icon->url_black))
    {
        echo '<img  src="/images/arenda_types_images/'.$icon->arenda_type_id.'/'.$icon->url_black.'">';
    }
    ?>

    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'url') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <?= Html::a('Вернуться к списку', ['/tree/admin/arendatypes'], ['class' => 'btn btn-default']) ?>
</div><!-- site-edit -->
