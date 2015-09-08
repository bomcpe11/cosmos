<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\icons\Icon;
use app\models\EfProjectType;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EfProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ef Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ef-project-index">

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
                            [
                                'attribute' => 'PROJECT_TYPE_ID',
                                'value' => function ($model, $key, $index, $column) {
                                    return EfProjectType::findOne($model[$column->attribute])->PROJECT_TYPE_NAME;
                                }
                            ],
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
                                'buttons' => [
                                    'delete' => function($url, $model) {
                                        return Html::a(Icon::show('trash', [], Icon::BSG),
                                                        ['delete'],
                                                        [
                                                            'title' => 'Delete',
                                                            'class '=> 'delete-button',
                                                            'data-id' => $model->PROJECT_ID
                                                        ]);
                                    }
                                ]
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
                'heading' => 'กองทุนสิ่งแวดล้อม', 
                'type'=>GridView::TYPE_PRIMARY,
            ],
            'persistResize'=>false,
            'export' => false,                                                       
    ]); ?>
</div>

<?php
$js = <<<JS
    $('.delete-button').on('click', function(event) {
        event.preventDefault();
        var id = $(this).attr('data-id'),
            url = $(this).attr('href');

        bootbox.confirm('กรุณายืนยัน', function(result) {
            if (result) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {id: id}
                })
                .done(function(data, textStatus, jqXHR) {
                    bootbox.alert('ลบข้อมูลสำเร็จ', function() {
                        location.reload();
                    });
                })
                .fail(function(textSatatus, jqXHR, errorThrow) {
                    bootbox.alert(errorThrow);
                });
            }
        });
    });
JS;

$this->registerJs($js);
?>
