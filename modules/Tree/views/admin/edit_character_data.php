<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\Tree\assets\TreeAsset;
TreeAsset::register($this);
$this->params['breadcrumbs'][] = ['label' => 'Технические характеристики', 'url' => ['charact']];
$this->params['breadcrumbs'][] = ['label' => $par->name, 'url' => ['viewcharact?id='.$par->id]];
$this->params['breadcrumbs'][] = 'Редактирование данной "'.$model->name.'"';
/* @var $this yii\web\View */
/* @var $model app\modules\regions\models\ModArendaRegions */
/* @var $form ActiveForm */
$session = Yii::$app->session;
echo $session->getFlash('ch_data');
?>
<div class="site-edit">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?= Html::a('Вернуться к списку', ['viewcharact','id'=>$par->id], ['class' => 'btn btn-default']) ?>
    <br>
    <h2>Редактирование данной <?=$model->name?></h2>
    <?= $form->field($model, 'name') ?>

    <h2>Использование данной <?=$model->name?> в категориях:</h2>
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
    <br>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <?= Html::a('Вернуться к списку', ['viewcharact','id'=>$par->id], ['class' => 'btn btn-default']) ?>
</div><!-- site-edit -->
