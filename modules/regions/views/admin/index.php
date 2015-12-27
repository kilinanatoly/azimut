<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->params['breadcrumbs'][] = 'Регионы и города';
use app\modules\regions\assets\RegionsAsset;
RegionsAsset::register($this);
?>
<div class="row">
    <?php
    if (!empty($success))
    {
        echo '
        <div class="alert alert-success">Добавлен новый регион: '.$success->name.'</div>
        ';
    }
     if (!empty(Yii::$app->session->get('region_id')))
    {
        $reg_id =Yii::$app->session->get('region_id');
        $city_name =Yii::$app->session->get('city_name');
        echo '
        <div class="alert alert-success">Добавлен новый город: '.$city_name.'</div>
        ';
    }
    else
    {
        $reg_id=0;
    }

    $session = Yii::$app->session;
    unset($_SESSION['region_id']);
    unset($_SESSION['city_name']);

    ?>
    <div class="panel-group col-md-7" id="accordion">

        <?php
        $form = ActiveForm::begin([
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => '{label}{input}',
            ],
        ]);
        ?>
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
        <?= $form->field($model1, 'name')->label('Добавить регион') ?>

        <?php

        foreach ($region_list as $key => $value) {
            echo '
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse' . ($key + 1) . '"> <span class="badge pull-right">' . count($value['cities']) . '</span>
                    ' . $value['name'] . '
                </a><a href="'.Url::to(['/regions/admin/editregion', 'region_id' => $value['id']]).'"><span  title="Редактирвоать"  class="glyphicon glyphicon-pencil"></span></a>' . (count($value['cities']) != 0 ? '<b style="margin-left:3px;">Удалить нельзя</b>' : Html::checkbox('delete_region[' . $value['id'] . ']', false, ['label' => 'Удалить', 'style' => 'margin-left:5px;'])) . '
            </h4>
        </div>
        <div id="collapse' . ($key + 1) . '" class="panel-collapse collapse'.($reg_id==$value['id'] ? 'in': '').'">
            <div class="panel-body">';
            if (!count($value['cities'])) {
                echo '<p>Нет элементов</p>';

            } else {
                foreach ($value['cities'] as $key2 => $value2) {
                    echo '<p><a onclick="return false;" href="' . Url::to(['#']) . '">' . $value2['name'] . '</a><a style="margin-left:5px;" href="'.Url::to(['/regions/admin/editcity', 'city_id' => $value2['id']]).'"><span title="Редактировать" class="glyphicon glyphicon-pencil"></span></a>'. Html::checkbox('delete_city[' . $value2['id'] . ']', false, ['label' => 'Удалить', 'style' => 'margin-left:5px;']) . '</p>';
                }
            }
           ?>
            <?= $form->field($model, 'region_id')->hiddenInput(['value' => $value['id']])->label(false, ['style' => 'display:none, margin:0']) ?>
            <?= Html::a('Добавить город', ['/regions/admin/create_city', 'id' => $value['id']]) ?>
            <?php
            echo '
    </div>
</div>
</div>
';
        }
        ?>





        <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary','style'=>'margin-top:10px']) ?>
        </div>
        <?php ActiveForm::end();
        ?>
    </div>
</div>
