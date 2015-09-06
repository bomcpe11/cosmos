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
/* @var $searchModel app\models\EfGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ef-group-index">

<h1><?= Html::encode($this->title) ?></h1>
<?php Pjax::begin();?>
    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [

                        [
                            'attribute'=>'GROUP_NAME', 
                            'vAlign'=>'middle', 
                            'filterType'=>GridView::FILTER_SELECT2,
                            'filter'=>ArrayHelper::map(app\models\EfGroup::find()->orderBy('GROUP_NAME')->asArray()->all(), 'GROUP_ID', 'GROUP_NAME'), 
                            'filterWidgetOptions'=>[
                                'pluginOptions'=>['allowClear'=>true, 'width'=>'auto'],
                            ],
                            'filterInputOptions'=>['placeholder'=>''],
                        ] ,                                          
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
                                				'index.php?r=group-user&group_id='.$key);
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
                                                                'data-value' => 'index.php?r=group/update&id='.$key,                    
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
            'pjax'=>true,
  'toolbar'=> [
                    [
                        'content'=> Html::a (  '<i class="glyphicon glyphicon-plus"></i>',
                                                '#', 
                                                [   'class' => 'btn btn-success activity-view-link',
                                                    'title' => Yii::t('yii', 'View'),
                                                    'data-value' => 'index.php?r=group/create',                    
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
                'heading' => 'User Group', 
                'type'=>GridView::TYPE_PRIMARY,
            ],
            'persistResize'=>false,
            'export' => false,                                                       
    ]); ?>
<?php Pjax::end(); ?>
</div>

<?php
        Modal::begin([
                        'id' => 'modal-ef-group' ,
                        'size' => 'modal-lg' ,
                    ]);
        echo "<div id = 'modal-ef-group-content'></div>";
        Modal::end() ;
?>           

<?php Modal::begin([
    'id' => 'activity-modal',
    'header' => '<h4 class="modal-title">User Group</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',

]); ?>

<div class="well">


</div>


<?php Modal::end(); ?>



<?php
$script = <<< JS
    
     
    $.close_modal = function(){
            $('#modal-ef-group').modal('hide') ;
            location.reload() ;
    };
    $('#modalClnStaffButton').click(function(){
                $('#modal-ef-group').modal('show')
                .find('#modal-ef-group-content')
                .load($(this).attr('value'));
    }); 
        
    $('.activity-view-link').click(function() {
        var data_value = $(this).attr("data-value") ;
        $('#modal-ef-group').modal('show')
                .find('#modal-ef-group-content')
                .load(data_value);
    });
     
                
JS;
$this->registerJs($script) ;
?>