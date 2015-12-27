<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\modules\tree\assets\TreeAsset;
TreeAsset::register($this);
$this->params['breadcrumbs'][] = 'Типы аренды';
$session = Yii::$app->session;
echo $session->getFlash('add');
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name')->label('Добавить тип аренды') ?>

<div class="form-group">
    <?= Html::submitButton('Добавить Добавить тип аренды', ['class' => 'btn btn-primary']) ?>
</div>
<h4>Типы аренды:</h4>
<?php ActiveForm::end(); ?>
<?php
echo '<div class="list-group">';
foreach ($data as $key => $value) {
    echo '
 <a href="' . Url::to(['/tree/admin/viewarendatype', 'id' => $value['id']]) . '" class="list-group-item">'. $value['name'] .'</a>
    ';
}
echo '</div>';
?>









