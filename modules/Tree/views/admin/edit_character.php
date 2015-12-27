<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\Tree\assets\TreeAsset;
TreeAsset::register($this);
/* @var $this yii\web\View */
/* @var $model app\modules\regions\models\ModArendaRegions */
/* @var $form ActiveForm */
?>
<div class="site-edit">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <?= Html::a('Вернуться к списку', ['/tree/admin/charact'], ['class' => 'btn btn-default']) ?>
</div><!-- site-edit -->
