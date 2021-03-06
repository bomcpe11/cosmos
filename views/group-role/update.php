<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EfGroupRole */

$this->title = 'Update Ef Group Role: ' . ' ' . $model->GROUP_ROLE_ID;
$this->params['breadcrumbs'][] = ['label' => 'Ef Group Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->GROUP_ROLE_ID, 'url' => ['view', 'id' => $model->GROUP_ROLE_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ef-group-role-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
