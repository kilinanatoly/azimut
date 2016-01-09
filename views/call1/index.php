<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ZaprosPriceMessagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Запросы коммерческих предложений';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zapros-price-messages-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'email:email',
            'tel',
            'product_id',
            // 'reg_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
