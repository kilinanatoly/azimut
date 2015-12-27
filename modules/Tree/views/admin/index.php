<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\Tree\assets\TreeAsset;
use app\modules\Tree\models\ModArendaTree;
TreeAsset::register($this);
$b_id = $parent_id;
$result = ModArendaTree::findOne(['id'=>$b_id]);
if ($result){
    $this_cat = $result;
    $this->params['breadcrumbs'][] = ['label' => 'Весь список категорий', 'url' => ['/tree/admin']];

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
    $this->params['breadcrumbs'][] = 'Структура категории "' . $this_cat->name . '"';
    $h2 = '<h2>Структура категории "' . $this_cat->name . '"</h2>';

}else{
    $this->params['breadcrumbs'][] = 'Весь список категорий';
    $h2='';
}


$session = Yii::$app->session;
echo $session->getFlash('add_cat');
echo $session->getFlash('delete_cat');
?>

<div class="admin-default-index">

    <div class="col-lg-12">
        <?=$h2?>
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
        <?= $form->field($model, 'name') ?>
        <div id="menu" class="menu">
            <?php
            echo $data;
            ?>
        </div>


        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>







