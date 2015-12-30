<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\modules\Tree\assets\TreeAsset;
TreeAsset::register($this);
$this->params['breadcrumbs'][] = ['label' => 'Технические характеристики', 'url' => ['charact']];
$this->params['breadcrumbs'][] = 'Редактирование характеристики "'.$data[0]['name'].'"';
$session = Yii::$app->session;
echo $session->getFlash('char_data');
?>
<?php $form = ActiveForm::begin(); ?>


<?php ActiveForm::end(); ?>
<?php
$form = ActiveForm::begin();
?>
<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'style' => 'margin-top:10px;']) ?>
</div>
<div class="form-group">
    <a href="/tree/admin/charact" class="btn btn-default">Вернуться к списку характеристик</a>
</div>
<?php
foreach ($data as $key => $value) {
    //Проверяем какой тип характеристики
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
    <div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse' . $value['id'] . '">
                    ' . $value['name'] . '
                    </a><a href="' . Url::to(['/tree/admin/editcharacter', 'id' => $value['id']]) . '"><span  title="Редактироаать"  class="glyphicon glyphicon-pencil"></span></a>' . (count($value['characters_data']) != 0 ? '<b style="margin-left:3px;">Удалить нельзя</b>' : Html::checkbox('delete_character[' . $value['id'] . ']', false, ['label' => 'Удалить', 'style' => 'margin-left:5px;'])) . ' .
                </a>
            </h4>
        </div>
        <div id="collapse' . $value['id'] . '" class="panel-collapse collapse in ">
            <div class="panel-body">
            <div class="row">
                <div class="col-md-5">';

    echo '</div></div>';//col-lg-5 end
    echo '
    <div class="row">
        <div class="col-md-12">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">Использовать техническую характеристику "' . $value['name'] . '" в категориях:</h3>
                    </div>
                    <div class="panel-body">
                        ' . $tree . '
                    </div>
                </div>
        </div>
    </div>
    ';
    echo '
    ';
}
?>
<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'style' => 'margin-top:10px;']) ?>
</div>
<?php ActiveForm::end(); ?>
<a href="/tree/admin/charact" class="btn btn-default">Вернуться к списку характеристик</a>








