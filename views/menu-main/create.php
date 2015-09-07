<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EfMenuMain */

$this->title = 'สร้างเมนูหลัก';
$this->params['breadcrumbs'][] = ['label' => 'เมนูหลัก', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ef-menu-main-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
