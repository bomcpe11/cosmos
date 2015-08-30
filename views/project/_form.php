<?php

use yii\helpers\Html;

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\EfProject */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ef-project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'PROJECT_ID')->textInput() ?>

    <?= $form->field($model, 'FISCAL_YEAR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PROJECT_TYPE_ID')->textInput() ?>

    <?= $form->field($model, 'PLAN_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MAIN_PRODUCTIVITY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PROJECT_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UNIT_ID')->textInput() ?>

    <?= $form->field($model, 'DIVISION_ID')->textInput() ?>

    <?= $form->field($model, 'START_DATE')->textInput() ?>

    <?= $form->field($model, 'END_DATE')->textInput() ?>

    <?= $form->field($model, 'BUDGET_TYPE_ID')->textInput() ?>

    <?= $form->field($model, 'BUDGET_RECEIVE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BUDGET_ACTUAL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PROJECT_STATUS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PROJ_HDLR_ID')->textInput() ?>

    <?= $form->field($model, 'CONTRACT_NUM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PLACE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AMPHOE_CODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PROVINCE_CODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRINC_N_REASON')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'OBJECTIVE')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'TARGET')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'TARGET_GROUP')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'OUTPUT')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'INDICATOR')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'RESULT')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'SCOPE')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'PLAN')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'CREATE_BY')->textInput() ?>

    <?= $form->field($model, 'CREATE_DATE')->textInput() ?>

    <?= $form->field($model, 'LAST_UPD_BY')->textInput() ?>

    <?= $form->field($model, 'LAST_UPD_DATE')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
