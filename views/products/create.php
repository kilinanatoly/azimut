<?php
@session_start();
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form ActiveForm */
$this->title = 'Добавление товара в категорию "'.$parent->name.'"';
$this->params['breadcrumbs'][] = ['label'=>$_SESSION['cat_r'],'url'=>$_SESSION['cat']] ;
$this->params['breadcrumbs'][] = $this->title ;
?>
<div class="products-create">
    <input type="hidden" id="parent_id" value="<?=$parent->id?>">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

        <?= $form->field($model, 'name')->textInput()->label('Название') ?>
    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
    ]) ?>
        <?= $form->field($model, 'price')->textInput()->label('Цена (0 - по запросу)') ?>
        <?= $form->field($model, 'imageFile')->fileInput() ?>

        <?= $form->field($model, 'active')->checkbox() ?>
        <?= $form->field($model, 'special')->checkbox() ?>


        <div class="characteristics">
        </div>
        <div class="form-group">
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
        </div>
    <div class="form-group">
        <a  class="btn btn-default" href="/products/<?=$_SESSION['cat']?>">Вернуться к списку</a>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- products-create -->
