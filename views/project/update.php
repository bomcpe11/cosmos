<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EfProject */

$this->title = 'Update Ef Project: ' . ' ' . $model->PROJECT_ID;
$this->params['breadcrumbs'][] = ['label' => 'Ef Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PROJECT_ID, 'url' => ['view', 'id' => $model->PROJECT_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ef-project-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
