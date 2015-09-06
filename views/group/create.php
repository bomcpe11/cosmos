<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EfGroup */

$this->title = 'Create Ef Group';
$this->params['breadcrumbs'][] = ['label' => 'Ef Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ef-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
