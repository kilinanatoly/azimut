<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\Tree\assets\TreeAsset;
use app\modules\Tree\models\ModArendaTree;

TreeAsset::register($this);
$this->params['breadcrumbs'][] = ['label' => 'Весь список категорий', 'url' => ['index']];
$b_id = $model->id;

$result = ModArendaTree::findOne(['id'=>$b_id]);
$cat_parent = $result->parent_id;

$nn_mas = [];
while($result->parent_id!=0)
{
    $result = ModArendaTree::findOne(['id'=>$result->parent_id]);
    $nn_mas[] = [
        'id'=>$result->id,
        'name'=>$result->name,
    ];
}
for  ($i = count($nn_mas)-1;$i>=0;$i--)
{
    $this->params['breadcrumbs'][] = ['label' => $nn_mas[$i]['name'], 'url' => ['/tree/admin?parent_id='.$nn_mas[$i]['id']]];
}

$this->params['breadcrumbs'][] = 'Редактирование категории "' . $model->name . '"';
/* @var $this yii\web\View */
/* @var $model app\modules\regions\models\ModArendaRegions */
/* @var $form ActiveForm */
$new_active_cats = [];
foreach ($active_cats as $key => $value) {
    $new_active_cats[] = $value['character_id'];
}
$new_active_podcats = [];
foreach ($active_podcats as $key => $value) {
    $new_active_podcats[] = $value['character_data_id'];
}
$session = Yii::$app->session;
echo $session->getFlash('char1');
echo $session->getFlash('delete_cat');
?>

<div class="site-edit">
<h2>Редактирование категории <?=$model->name?></h2>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>

    </div>

    <div class="form-group">
        <?= Html::a('Вернуться к списку', [($cat_parent!=0 ? '/tree/admin?parent_id='.$cat_parent : '/tree/admin/')], ['class' => 'btn btn-default']) ?>
    </div>
    <div class="form-group">
        <?php
        $res = \app\modules\Tree\models\ModArendaTree::findOne(['parent_id' => $model->id]);
        if ($res) {
            echo '
            <div class="alert alert-danger" role="alert">Удалить категорию нельзя (является родителем)</div>';
        } else {
            echo '<a class="btn btn-danger" href="/tree/admin/deletecat?id=' . $model->id . '" data-confirm="Вы действительно хотите удалить категорию?" data-method="post">Удалить</a>';
        }
        ?>
    </div>

    <?= $form->field($model_upload, 'imageFile')->fileInput()->label('Иконка') ?>
    <?php
        if (!empty($icon))
        {
            echo '<img  src="/images/cats_images/'.$icon->cat_id.'/'.$icon->url.'">';
        }
    ?>

    <?= $form->field($model, 'id')->hiddenInput(['style' => 'display:none'])->label('') ?>
    <?= $form->field($model, 'name')->label('Название категории') ?>
    <?= $form->field($model, 'url')->label('URL') ?>
    <?php
    //    $cats_p = [];
    //    foreach ($all_cats as $key => $value) {
    //        $cats_p[$value['id']]['id'] = $value['id'];
    //        $cats_p[$value['id']]['name'] = $value['name'];
    //        $cats_p[$value['id']]['parent_id'] = $value['parent_id'];
    //    }
    //
    //    foreach ($all_cats as $key => $value) {
    //        $parent_id = $value['parent_id'];
    //        while ($parent_id != 0) {
    //            $all_cats[$key]['name'] = '&nbsp;&nbsp;&nbsp;&nbsp;' . $all_cats[$key]['name'];
    //
    //            $parent_id = $cats_p[$parent_id]['parent_id'];
    //
    //        }
    //    }

    ?>
    <div class="form-group field-modarendatree-parent_id">
        <label class="control-label" for="modarendatree-parent_id">Родитель</label>
        <select id="modarendatree-parent_id" class="form-control" name="ModArendaTree[parent_id]">

            <option value="">Выберите родителя</option>
            <?php
            echo $all_cats;
            ?>
        </select>
    </div>

    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Прикрепить к характеристикам:</h3>
        </div>
        <div class="panel-body">
            <?php
            foreach ($all_characters as $key => $value) {
                if (in_array($value['id'], $new_active_cats)) {
                    $check = Html::checkbox('cats[' . $value['id'] . ']', true, ['label' => '', 'class' => 'p1_check', 'style' => 'margin-left:5px;']);
                } else {
                    $check = Html::checkbox('cats[' . $value['id'] . ']', false, ['label' => '', 'class' => 'p1_check', 'style' => 'margin-left:5px;']);
                }
                echo '<div class="panel panel-default">
                      <div class="panel-heading p1" style="background-color:#C6DDFF;"><span class="glyphicon glyphicon-cog"></span> ' . $value['name'] . '<a target="_blank" href="/tree/admin/viewcharact?id=' . $value['id'] . '"><span style="color:black;margin:0 4px;" class="glyphicon glyphicon-pencil" title="Редактировать"></span></a>' . $check . '</div>
                          <div class="panel-body p1_body">
                           ';
                if (!empty($value['charact_data'])) {
                    foreach ($value['charact_data'] as $key2 => $value2) {
                        if (in_array($value2['id'], $new_active_podcats)) {
                            $check2 = Html::checkbox('add_cat_for_character_data[' . $value2['id'] . ']', true, ['label' => '', 'style' => 'margin-left:5px;']);
                        } else {
                            $check2 = Html::checkbox('add_cat_for_character_data[' . $value2['id'] . ']', false, ['label' => '', 'style' => 'margin-left:5px;']);
                        }
                        echo '<p>' . $value2['name'] . $check2 . '</p>';
                    }

                } else {
                    echo '<p>Нет данных</p>';
                }
                echo '
                          </div>
                  </div>';
            }
            ?>
        </div>
    </div>

    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Прикрепить к типам аренды:</h3>
        </div>
        <div class="panel-body">
            <?php
            echo '<div class="panel panel-default">
                      <div class="panel-heading" style="background-color:#C6DDFF;"><span class="glyphicon glyphicon-tags" style="margin-right:5px"></span>Выберите типы Аренды:</div>
                          <div class="panel-body">
                           ';
            foreach ($active_arenda_types as $key => $value) {
                $new_active_arenda_types[] = $value['arenda_type_id'];
            }
            foreach ($arenda_types as $key => $value) {
                if (!empty($new_active_arenda_types)) {
                    if (in_array($value['id'], $new_active_arenda_types)) {
                        $check = Html::checkbox('add_cat_for_arenda_type[' . $value['id'] . ']', true, ['label' => '', 'style' => 'margin-left:5px;']);
                    } else {
                        $check = Html::checkbox('add_cat_for_arenda_type[' . $value['id'] . ']', false, ['label' => '', 'style' => 'margin-left:5px;']);
                    }
                } else {
                    $check = Html::checkbox('add_cat_for_arenda_type[' . $value['id'] . ']', false, ['label' => '', 'style' => 'margin-left:5px;']);
                }
                echo '<p>' . $value['name'] . $check . '</p>';

            }
            echo '
                          </div>
                  </div>';
            ?>
        </div>
    </div>

    <?= $form->field($model, 'active')->checkbox() ?>
    <?= $form->field($model, 'use_name_for_ads')->checkbox() ?>
    <?= $form->field($model, 'name_for_ads')->textInput()->label('Заголовок текстового поля с названием') ?>
    <?= $form->field($model, 'use_rub_km')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <?= Html::a('Вернуться к списку', ['/tree/admin/'], ['class' => 'btn btn-default']) ?>
</div><!-- site-edit -->
