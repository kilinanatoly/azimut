<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EmailTo */
/* @var $form ActiveForm */
$this->params['breadcrumbs'][]='Получатели email сообщений';

?>
<div class="site-emailto">
    <p>Добавьте в поле всех получателей email сообщений от клиентов.Разделитель ";"</p>
    <p>Пример: example@gmail.com;example1@yandex.ru;example2@gmail.com</p>
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'email_to') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-emailto -->
