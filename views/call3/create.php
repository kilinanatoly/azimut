<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CallMeMessages */

$this->title = 'Create Call Me Messages';
$this->params['breadcrumbs'][] = ['label' => 'Call Me Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="call-me-messages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
