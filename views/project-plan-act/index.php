<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EfProjectPlanActSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ef Project Plan Acts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ef-project-plan-act-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Ef Project Plan Act'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'PROJECT_PLAN_ACT_ID',
            'PLAN_ACT_NAME',
            'SEQ',
            'BUDGET_PLAN',
            'LEVEL',
            // 'PARENT_ID',
            // 'PROJECT_ID',
            // 'STATUS',
            // 'CREATE_BY',
            // 'CREATE_DATE',
            // 'LAST_UPD_BY',
            // 'LAST_UPD_DATE',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
