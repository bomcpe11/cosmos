<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EfGroupRole */

$this->title = 'Create Ef Group Role';
$this->params['breadcrumbs'][] = ['label' => 'Ef Group Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ef-group-role-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
