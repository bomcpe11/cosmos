<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EfProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ef Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ef-project-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ef Project', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'PROJECT_ID',
            'FISCAL_YEAR',
            'PROJECT_TYPE_ID',
            'PLAN_NAME',
            'MAIN_PRODUCTIVITY',
            // 'PROJECT_NAME',
            // 'UNIT_ID',
            // 'DIVISION_ID',
            // 'START_DATE',
            // 'END_DATE',
            // 'BUDGET_TYPE_ID',
            // 'BUDGET_RECEIVE',
            // 'BUDGET_ACTUAL',
            // 'PROJECT_STATUS',
            // 'PROJ_HDLR_ID',
            // 'CONTRACT_NUM',
            // 'PLACE',
            // 'AMPHOE_CODE',
            // 'PROVINCE_CODE',
            // 'PRINC_N_REASON:ntext',
            // 'OBJECTIVE:ntext',
            // 'TARGET:ntext',
            // 'TARGET_GROUP:ntext',
            // 'OUTPUT:ntext',
            // 'INDICATOR:ntext',
            // 'RESULT:ntext',
            // 'SCOPE:ntext',
            // 'PLAN:ntext',
            // 'CREATE_BY',
            // 'CREATE_DATE',
            // 'LAST_UPD_BY',
            // 'LAST_UPD_DATE',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
