<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\grid\EditableColumn ;
use kartik\datecontrol\DateControl;
use kartik\grid\DataColumn;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EfMenuMainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'เมนูหลัก';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ef-menu-main-index">

<h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [

                        [
                            'attribute'=>'MENU_MAIN_NAME', 
                            'vAlign'=>'middle', 
                            'filterType'=>GridView::FILTER_SELECT2,
                            'filter'=>ArrayHelper::map(app\models\EfMenuMain::find()->orderBy('MENU_MAIN_NAME')->asArray()->all(), 'MENU_MAIN_ID', 'MENU_MAIN_NAME'), 
                            'filterWidgetOptions'=>[
                                'pluginOptions'=>['allowClear'=>true, 'width'=>'auto'],
                            ],
                            'filterInputOptions'=>['placeholder'=>''],
                        ] ,
            			'DESCRIPTION',
            			'SEQ',
                        [
                            'attribute'=>'STATUS', 
                        	'value'=>function ($model, $key, $index, $widget) {
                        		$gender_desc = Yii::$app->params['statuses'];
                        		return $gender_desc[$model->STATUS] ;
                        		},
                            'vAlign'=>'middle', 
                            'filterType'=>GridView::FILTER_SELECT2,
                            'filter'=> Yii::$app->params['statuses'], 
                            'filterWidgetOptions'=>[
                                'pluginOptions'=>['allowClear'=>true, 'width'=>'auto'],
                            ],
                            'filterInputOptions'=>['placeholder'=>''],
                        ],
                        [
                        'class' => 'kartik\grid\ActionColumn',
                        		'template' => '{link1}',
						        'headerOptions' => ['width' => '20%'],
						        'contentOptions' => ['class' => 'padding-left-5px'],
						        'buttons' => [
                                		'link1' => function ($url, $model, $key) {
                                		return Html::a  (   '<span class="glyphicon glyphicon-search"></span>',
                                				'index.php?r=menu-sub&menu_main_id='.$key);
                                		},
                                		],],
                                             
                                             [
        'class' => 'kartik\grid\ActionColumn',
        'template' => '{update} {delete}',
        'headerOptions' => ['width' => '20%'],
        'contentOptions' => ['class' => 'padding-left-5px'],

        'buttons' => [
            'update' => function ($url, $model, $key) {
                                        return Html::a  (   '<span class="glyphicon glyphicon-eye-open"></span>',
                                                            '#', 
                                                            [   'class' => 'activity-view-link',
                                                                'title' => Yii::t('yii', 'View'),
                                                                'data-value' => 'index.php?r=menu-main/update&id='.$key,                    
                                                            ]
                                                        );           
                         },
            ],],
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
                        'content'=> Html::a (  '<i class="glyphicon glyphicon-plus"></i>',
                                                '#', 
                                                [   'class' => 'btn btn-success activity-view-link',
                                                    'title' => Yii::t('yii', 'View'),
                                                    'data-value' => 'index.php?r=menu-main/create',                    
                                                ]
                                            )
                                    . ' ' .                       
                                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>'Reset Grid'])          
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

<?php
        Modal::begin([
                        'id' => 'modal-ef-menu-main' ,
                        'size' => 'modal-lg' ,
                    ]);
        echo "<div id = 'modal-ef-menu-main-content'></div>";
        Modal::end() ;
?>           

<?php Modal::begin([
    'id' => 'activity-modal',
    'header' => '<h4 class="modal-title">Menu Main</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',

]); ?>

<div class="well">


</div>


<?php Modal::end(); ?>



<?php
$script = <<< JS
    
     
    $.close_modal = function(){
            $('#modal-ef-menu-main').modal('hide') ;
            location.reload() ;
    };
        
    $('.activity-view-link').click(function() {
        var data_value = $(this).attr("data-value") ;
        $('#modal-ef-menu-main').modal('show')
                .find('#modal-ef-menu-main-content')
                .load(data_value);
    });
		
                
JS;
$this->registerJs($script) ;
?>