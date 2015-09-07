<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EfProjectPlanAct */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Ef Project Plan Act',
]) . ' ' . $model->PROJECT_PLAN_ACT_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ef Project Plan Acts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PROJECT_PLAN_ACT_ID, 'url' => ['view', 'id' => $model->PROJECT_PLAN_ACT_ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ef-project-plan-act-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
