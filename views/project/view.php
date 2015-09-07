<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EfProject */

$this->title = $model->PROJECT_ID;
$this->params['breadcrumbs'][] = ['label' => 'Ef Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ef-project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->PROJECT_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->PROJECT_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'PROJECT_ID',
            'FISCAL_YEAR',
            'PROJECT_TYPE_ID',
            'PLAN_NAME',
            'MAIN_PRODUCTIVITY',
            'PROJECT_NAME',
            'UNIT_ID',
            'DIVISION_ID',
            'START_DATE',
            'END_DATE',
            'BUDGET_TYPE_ID',
            'BUDGET_RECEIVE',
            'BUDGET_ACTUAL',
            'PROJECT_STATUS',
            'PROJ_HDLR_ID',
            'CONTRACT_NUM',
            'PLACE',
            'AMPHOE_CODE',
            'PROVINCE_CODE',
            'PRINC_N_REASON:ntext',
            'OBJECTIVE:ntext',
            'TARGET:ntext',
            'TARGET_GROUP:ntext',
            'OUTPUT:ntext',
            'INDICATOR:ntext',
            'RESULT:ntext',
            'SCOPE:ntext',
            'PLAN:ntext',
            'CREATE_BY',
            'CREATE_DATE',
            'LAST_UPD_BY',
            'LAST_UPD_DATE',
        ],
    ]) ?>

</div>
