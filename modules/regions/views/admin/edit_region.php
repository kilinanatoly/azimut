<?php
$session = Yii::$app->session;
echo $session->getFlash('alerts');

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\regions\assets\RegionsAsset;
RegionsAsset::register($this);


/* @var $this yii\web\View */
/* @var $model app\modules\regions\models\ModArendaRegions */
/* @var $form ActiveForm */
$this->title = 'Редактирование региона '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Регионы и города', 'url' => ['index   ']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-edit">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'url') ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
    <?= Html::a('Вернуться к списку', ['/regions/admin'], ['class' => 'btn btn-default']) ?>
</div><!-- site-edit -->
