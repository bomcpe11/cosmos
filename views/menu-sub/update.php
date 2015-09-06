<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EfMenuSub */

$this->title = 'แก้ไขเมนูย่อย: ' . ' ' . $model->MENU_SUB_NAME;
$this->params['breadcrumbs'][] = ['label' => 'เมนูย่อย', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->MENU_SUB_ID, 'url' => ['view', 'id' => $model->MENU_SUB_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ef-menu-sub-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
