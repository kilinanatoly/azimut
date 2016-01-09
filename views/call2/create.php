<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BuyMessages */

$this->title = 'Create Buy Messages';
$this->params['breadcrumbs'][] = ['label' => 'Buy Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buy-messages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
