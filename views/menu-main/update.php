<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EfMenuMain */

$this->title = 'แก้ไขเมนูหลัก: ' . ' ' . $model->MENU_MAIN_NAME;
$this->params['breadcrumbs'][] = ['label' => 'เมนูหลัก', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->MENU_MAIN_NAME, 'url' => ['view', 'id' => $model->MENU_MAIN_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ef-menu-main-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
