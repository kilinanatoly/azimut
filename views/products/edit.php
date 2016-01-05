<?php
@session_start();
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form ActiveForm */
$this->title = 'Редактирование товара '.$model->name;
$this->params['breadcrumbs'][] = ['label'=>$_SESSION['cat_r'],'url'=>$_SESSION['cat']] ;
$this->params['breadcrumbs'][] = $this->title ;
?>
<div class="products-create">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <input type="hidden" id="parent_id" value="<?=$model->cat_id?>">

    <?= $form->field($model, 'name')->textInput()->label('Название') ?>
    <?= $form->field($model, 'cat_id')->dropDownList(ArrayHelper::map(\app\modules\Tree\models\ModArendaTree::find()->all(), 'id', 'name'))->label('Категория') ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
    ]) ?>
    <?= $form->field($model, 'price')->textInput()->label('Цена (0 - по запросу)') ?>
    <?= $form->field($model, 'imageFile')->fileInput() ?>
    <?php
    echo (empty($model->image) ? '<p>Фотография не загружена</p>' : '<img width=200" src="/img/products/'.$model->image.'"');
    ?>
    <div class="clearfix"></div>
    <?= $form->field($model, 'active')->checkbox() ?>
    <?= $form->field($model, 'special')->checkbox() ?>

    <?=$html?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <div class="form-group">
        <a  class="btn btn-default" href="/products/<?=$_SESSION['cat']?>">Вернуться к списку</a>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- products-create -->
