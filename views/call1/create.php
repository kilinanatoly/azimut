<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ZaprosPriceMessages */

$this->title = 'Create Zapros Price Messages';
$this->params['breadcrumbs'][] = ['label' => 'Zapros Price Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zapros-price-messages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
