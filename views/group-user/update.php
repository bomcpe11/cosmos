<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EfGroupUser */

$this->title = 'Update Ef Group User: ' . ' ' . $model->GROUP_USER_ID;
$this->params['breadcrumbs'][] = ['label' => 'Ef Group Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->GROUP_USER_ID, 'url' => ['view', 'id' => $model->GROUP_USER_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ef-group-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
