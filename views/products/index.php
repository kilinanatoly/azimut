<?php

/* @var $this yii\web\View */
use app\modules\Tree\assets\TreeAsset;
$this->title = 'Список товаров в категории '.$parent;
$this->params['breadcrumbs'][] = $this->title ;
TreeAsset::register($this);
echo $tree;
?>

