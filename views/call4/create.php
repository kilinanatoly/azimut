<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CallMeMain */

$this->title = 'Create Call Me Main';
$this->params['breadcrumbs'][] = ['label' => 'Call Me Mains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="call-me-main-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
