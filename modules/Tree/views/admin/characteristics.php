<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\modules\tree\assets\TreeAsset;
TreeAsset::register($this);
$this->params['breadcrumbs'][] = 'Технические характеристики';
$session = Yii::$app->session;
echo $session->getFlash('char');
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name')->label('Добавить характеристику') ?>

<div class="form-group">
    <?= Html::submitButton('Добавить характеристику', ['class' => 'btn btn-primary']) ?>
</div>
<h4>Технические характеристики:</h4>
<?php ActiveForm::end(); ?>
<?php
echo '<div class="list-group">';
foreach ($data as $key => $value) {
//    switch ($value['type']) {
//        case 'checkbox':
//            $type="чекбокс (много из многих)";
//            break;
//        case 'select':
//            $type="выпадающий список (один из многих)";
//            break;
//        case 'radio':
//            $type="радио группа (один из многих)";
//            break;
//        case 'textinput':
//            $type="маленькое текстовое поле";
//            break;
//        case 'textarea':
//            $type="большое текстовое поле";
//            break;
//    }
    echo '
 <a href="' . Url::to(['/tree/admin/viewcharact', 'id' => $value['id']]) . '" class="list-group-item">'. $value['name'] .'</a>


    ';
}
echo '</div>';
?>









