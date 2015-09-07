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
/* @var $searchModel app\models\EfMenuSubSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'เมนูย่อย';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ef-menu-sub-index">

<h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [

                        [
                            'attribute'=>'MENU_SUB_NAME', 
                            'vAlign'=>'middle', 
                            'filterType'=>GridView::FILTER_SELECT2,
                            'filter'=>ArrayHelper::map(app\models\EfMenuSub::find()->orderBy('MENU_SUB_NAME')->asArray()->all(), 'MENU_SUB_ID', 'MENU_SUB_NAME'), 
                            'filterWidgetOptions'=>[
                                'pluginOptions'=>['allowClear'=>true, 'width'=>'auto'],
                            ],
                            'filterInputOptions'=>['placeholder'=>''],
                        ] ,
            			'DESCRIPTION',
            			'MENU_LINK',
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
        'template' => '{update} {delete}',
        'headerOptions' => ['width' => '20%'],
        'contentOptions' => ['class' => 'padding-left-5px'],

        'buttons' => [
            'update' => function ($url, $model, $key) {
                                        return Html::a  (   '<span class="glyphicon glyphicon-eye-open"></span>',
                                                            '#', 
                                                            [   'class' => 'activity-view-link',
                                                                'title' => Yii::t('yii', 'View'),
                                                                'data-value' => 'index.php?r=menu-sub/update&id='.$key,                    
                                                            ]
                                                        );           
                         },

             'delete' => function ($url, $model, $key) {
	                         return Html::a  (   '<span class="glyphicon glyphicon-trash"></span>',
	                         		'index.php?r=menu-sub/delete&id='.$key.'&menu_main_id='.$model->MENU_MAIN_ID
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
                                                    'data-value' => 'index.php?r=menu-sub/create&menu_main_id='.$searchModel->MENU_MAIN_ID,                    
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
                'heading' => 'เมนูย่อย', 
                'type'=>GridView::TYPE_PRIMARY,
            ],
            'persistResize'=>false,
            'export' => false,                                                       
    ]); ?>
</div>

<?php
        Modal::begin([
                        'id' => 'modal-ef-menu-sub' ,
                        'size' => 'modal-lg' ,
                    ]);
        echo "<div id = 'modal-ef-menu-sub-content'></div>";
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
            $('#modal-ef-menu-sub').modal('hide') ;
            location.reload() ;
    };
        
    $('.activity-view-link').click(function() {
        var data_value = $(this).attr("data-value") ;
        $('#modal-ef-menu-sub').modal('show')
                .find('#modal-ef-menu-sub-content')
                .load(data_value);
    });
     
                
JS;
$this->registerJs($script) ;
?>