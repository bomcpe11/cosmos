<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EfGroupUser */

$this->title = 'Create Ef Group User';
$this->params['breadcrumbs'][] = ['label' => 'Ef Group Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ef-group-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
