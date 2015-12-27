<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\modules\Tree\assets\TreeAsset;
TreeAsset::register($this);
$this->params['breadcrumbs'][] = ['label' => 'Типы аренды', 'url' => ['arendatypes']];
$this->params['breadcrumbs'][] = 'Использование типа аренды "'.$model->name.'""';?>
<?php $form = ActiveForm::begin(); ?>


<?php ActiveForm::end(); ?>
<?php
$form = ActiveForm::begin();
?>
<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'style' => 'margin-top:10px;']) ?>
</div>
<div class="form-group">
    <a href="/tree/admin/arendatypes" class="btn btn-default">Вернуться к списку характеристик</a>
</div>
<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$model->id?>">
                    <?=$model->name?>
                </a>
                <a href="<?=Url::to(['/tree/admin/editarendatype', 'id' => $model->id])?>"><span title="Редактировать" class="glyphicon glyphicon-pencil"></span></a><?=Html::checkbox('delete_arenda_type[' . $model->id . ']', false, ['label' => 'Удалить', 'style' => 'margin-left:5px;'])?>
            </h4>
        </div>

        <div id="collapse<?=$model->id?>" class="panel-collapse collapse in ">
            <div class="panel-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-danger">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Использовать тип аренды  "<?=$model->name?>" в категориях:</h3>
                                </div>

                                <div class="panel-body">
                                    <?=$tree?>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'style' => 'margin-top:10px;']) ?>
</div>
<?php ActiveForm::end(); ?>
<a href="/tree/admin/arendatypes" class="btn btn-default">Вернуться к списку характеристик</a>








