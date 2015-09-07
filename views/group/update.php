<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EfGroup */

$this->title = 'Update Ef Group: ' . ' ' . $model->GROUP_ID;
$this->params['breadcrumbs'][] = ['label' => 'Ef Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->GROUP_ID, 'url' => ['view', 'id' => $model->GROUP_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ef-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
