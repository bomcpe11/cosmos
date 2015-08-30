<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EfProject */

$this->title = 'Create Ef Project';
$this->params['breadcrumbs'][] = ['label' => 'Ef Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ef-project-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
