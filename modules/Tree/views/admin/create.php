
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\Tree\assets\TreeAsset;
TreeAsset::register($this);
/* @var $this yii\web\View */
/* @var $model app\modules\regions\models\ModArendaRegions */
/* @var $form ActiveForm */
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->title = (!empty($parent) ? 'Добавление подкатегории в категорию '.$parent->name : 'Добавить категорию');
    $this->params['breadcrumbs'][] = $this->title;
if (!empty(Yii::$app->session->get('cat')))
{
    $cat =Yii::$app->session->get('cat');
    echo '
        <div class="alert alert-success">Добавлена новая категория: '.$cat.'</div>
        ';
    $session = Yii::$app->session;
    unset($_SESSION['cat']);
}



?>
<div class="site-edit">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <div class="form-group">
        <?= Html::a('Вернуться к списку категорий', ['/tree/admin'], ['class' => 'btn btn-default    ']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-edit -->
