<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\widgets\DepDrop;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\EfProjectPlanAct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ef-project-plan-act-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-3',
                'offset' => '',
                'wrapper' => 'col-sm-9',
                'error' => '',
                'hint' => '',
            ],
        ],
    ]); ?>

     <div class="panel panel-primary">
        <div class="panel-heading">แผนงาน/กิจกรรม</div>
        <div class="panel-body">
            <div class="col-sm-3">
                <?= $form->field($model, 'LEVEL', 
                                [
                                    'template' => "{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                                    'horizontalCssClasses' => [
                                        'wrapper' => 'col-sm-12',
                                        'error' => '',
                                        'hint' => ''
                                    ]
                                ])
                            ->radioList(Yii::$app->params['projectPlaneActLevel'], 
                                [
                                    'item' => function ($index, $label, $name, $checked, $value) {
                                        return '<div class="radio col-sm-12">'
                                                    .'<label><input type="radio" name="'.$name.'" value="'.$value.'"> '.$label.'</label>'
                                                .'</div>';
                                    }
                                ]); ?>
            </div>

            <!-- TODO: Move inline css to class -->
            <div class="col-sm-9" style="border-left: #337ab7 2px solid;">

                <?= $form->field($model, 'PROJECT_ID')
                            ->widget(Select2::classname(), [
                                        'data' => ArrayHelper::map($projectList, 'PROJECT_PLAN_ACT_ID', 'PLAN_ACT_NAME'),
                                        'options' => [
                                                        'placeholder' => 'กรุณาเลือกแผนงาน',
                                                        'class' => 'level-2 level-3'
                                                    ],
                                        'pluginOptions' => [
                                            'allowClear' => false
                                        ],
                                    ]) ?>

                <?=  $form->field($model, 'PARENT_ID')
                            ->widget(DepDrop::classname(), [
                                        'type' => DepDrop::TYPE_SELECT2,
                                        'select2Options' => [
                                            'pluginOptions' => [
                                                'allowClear' => false
                                            ]
                                        ],
                                        'options' => [
                                                        'class' => 'level-3'
                                                    ],
                                        'pluginOptions'=>[
                                            'depends'=>['efprojectplanact-project_id'],
                                            'initialize' => true,
                                            'url' => Url::to(['get-parent-list']),
                                            'loadingText' => 'Loading ...',
                                            'placeholder' => 'กรุณาเลือกแผนงาน',
                                        ]
                                    ]) ?>

                <?= $form->field($model, 'PLAN_ACT_NAME')
                            ->textInput([
                                        'maxlength' => true,
                                        'class' => 'level-1 level-2 level-3'
                                    ]) ?>

                <?= $form->field($model, 'SEQ')
                            ->textInput([
                                        'maxlength' => true,
                                        'class' => ''
                                        ]) ?>

                <?= $form->field($model, 'BUDGET_PLAN')
                            ->textInput(['maxlength' => true,
                                        'class' => '']) ?>

                <?= $form->field($model, 'STATUS')
                            ->textInput(['maxlength' => true,
                                        'class' => '']) ?>
            </div>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => 'center-block '.($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary')]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js = <<<JS
    $('input[name="EfProjectPlanAct[LEVEL]"]').on('change', function(event) {
        var level = $(this).val();

        $('[class^="level"]').prop('disabled', true);
        if (level == '1') {
            $('.level-1').prop('disabled', false);
        } else if (level == '2') {
            $('.level-2').prop('disabled', false);
        } else if (level == '3') {
            $('.level-3').prop('disabled', false);
        }
    });
JS;

    $this->registerJs($js);
?>