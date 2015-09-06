<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EfProjectPlanAct */

$this->title = $model->PROJECT_PLAN_ACT_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ef Project Plan Acts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ef-project-plan-act-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->PROJECT_PLAN_ACT_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->PROJECT_PLAN_ACT_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'PROJECT_PLAN_ACT_ID',
            'PLAN_ACT_NAME',
            'SEQ',
            'BUDGET_PLAN',
            'LEVEL',
            'PARENT_ID',
            'PROJECT_ID',
            'STATUS',
            'CREATE_BY',
            'CREATE_DATE',
            'LAST_UPD_BY',
            'LAST_UPD_DATE',
        ],
    ]) ?>

</div>
