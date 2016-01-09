<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CallMeMessages */

$this->title = 'Update Call Me Messages: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Call Me Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="call-me-messages-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
