<?php

use yii\helpers\Html;
use kartik\grid\GridView;

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

    <?php 
    //  echo GridView::widget([
    //     'dataProvider' => $dataProvider,
    //     'filterModel' => $searchModel,
    //     'columns' => [
    //         ['class' => 'yii\grid\SerialColumn'],

    //         'PROJECT_ID',
    //         'FISCAL_YEAR',
    //         'PROJECT_TYPE_ID',
    //         'PLAN_NAME',
    //         'MAIN_PRODUCTIVITY',
    //         // 'PROJECT_NAME',
    //         // 'UNIT_ID',
    //         // 'DIVISION_ID',
    //         // 'START_DATE',
    //         // 'END_DATE',
    //         // 'BUDGET_TYPE_ID',
    //         // 'BUDGET_RECEIVE',
    //         // 'BUDGET_ACTUAL',
    //         // 'PROJECT_STATUS',
    //         // 'PROJ_HDLR_ID',
    //         // 'CONTRACT_NUM',
    //         // 'PLACE',
    //         // 'AMPHOE_CODE',
    //         // 'PROVINCE_CODE',
    //         // 'PRINC_N_REASON:ntext',
    //         // 'OBJECTIVE:ntext',
    //         // 'TARGET:ntext',
    //         // 'TARGET_GROUP:ntext',
    //         // 'OUTPUT:ntext',
    //         // 'INDICATOR:ntext',
    //         // 'RESULT:ntext',
    //         // 'SCOPE:ntext',
    //         // 'PLAN:ntext',
    //         // 'CREATE_BY',
    //         // 'CREATE_DATE',
    //         // 'LAST_UPD_BY',
    //         // 'LAST_UPD_DATE',

    //         ['class' => 'yii\grid\ActionColumn'],
    //     ],
    // ]); ?>

    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                            [
                                'class'=>'kartik\grid\SerialColumn',
                                'contentOptions'=>['class'=>'kartik-sheet-style'],
                                'width'=>'36px',
                                'header'=>'',
                                'headerOptions'=>['class'=>'kartik-sheet-style']
                            ],

                            [
                                'attribute' => 'FISCAL_YEAR', 
                                'vAlign' => 'middle', 
                                'filterType' => GridView::FILTER_SELECT2,
                                'filter' => ['2558'=>'2558', '2557'=>'2557', '2556'=>'2556'], 
                                'filterWidgetOptions'=>[
                                    'pluginOptions'=>['allowClear'=>true, 'width'=>'auto'],
                                ],
                                'filterInputOptions'=>['placeholder'=>''],
                            ] ,
                            'PLAN_NAME',
                            //'จัดกลุ่ม',
                            [
                                'attribute'=>'PROJECT_STATUS', 
                                'value'=> function ($model, $key, $index, $widget) {
                                                return Yii::$app->params['projectStatuses'][$model->PROJECT_STATUS];
                                            },
                                'vAlign'=>'middle', 
                                'filterType'=>GridView::FILTER_SELECT2,
                                'filter'=> Yii::$app->params['projectStatuses'], 
                                'filterWidgetOptions'=>[
                                    'pluginOptions'=>['allowClear'=>true, 'width'=>'auto'],
                                ],
                                'filterInputOptions'=>['placeholder'=>''],
                            ],
                            'BUDGET_ACTUAL',
                     
                            [
                                'class' => 'kartik\grid\ActionColumn',
                                'template' => '{view} {update} {delete}',
                            ],
            ],
            'containerOptions'=> [
                    'style'=>'overflow: auto'
            ], 
            'headerRowOptions'=> [
                    'class'=>'kartik-sheet-style'
            ],
            'filterRowOptions'=> [
                    'class'=>'kartik-sheet-style'
            ],
            'pjax'=>false,
            'toolbar'=> [
                    [
                        'content'=> Html::a ('<i class="glyphicon glyphicon-plus"></i>',
                                                ['create'], 
                                                [   'class' => 'btn btn-success activity-view-link',
                                                    'title' => Yii::t('yii', 'View'),
                                                    'data-value' => 'index.php?r=menu-main/create',                    
                                                ]
                                            )
                                    . ' ' .                       
                                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', 
                                            ['index'], 
                                            [
                                                'data-pjax'=>0, 
                                                'class'=>'btn btn-default', 
                                                'title'=>'Reset Grid'
                                            ])          
                    ] ,                                          
                    '{export}',
                    '{toggleData}',
            ] , 
            'export'=>['fontAwesome'=>true] ,
            'bordered'=>true,
            'striped'=>true,
            'condensed'=>true,
            'responsive'=>true,
            'hover'=>true,
            'showPageSummary'=>true,
            'panel'=> [
                'heading' => 'เมนูหลัก', 
                'type'=>GridView::TYPE_PRIMARY,
            ],
            'persistResize'=>false,
            'export' => false,                                                       
    ]); ?>
</div>

</div>
