<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EfProjectSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ef-project-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'PROJECT_ID') ?>

    <?= $form->field($model, 'FISCAL_YEAR') ?>

    <?= $form->field($model, 'PROJECT_TYPE_ID') ?>

    <?= $form->field($model, 'PLAN_NAME') ?>

    <?= $form->field($model, 'MAIN_PRODUCTIVITY') ?>

    <?php // echo $form->field($model, 'PROJECT_NAME') ?>

    <?php // echo $form->field($model, 'UNIT_ID') ?>

    <?php // echo $form->field($model, 'DIVISION_ID') ?>

    <?php // echo $form->field($model, 'START_DATE') ?>

    <?php // echo $form->field($model, 'END_DATE') ?>

    <?php // echo $form->field($model, 'BUDGET_TYPE_ID') ?>

    <?php // echo $form->field($model, 'BUDGET_RECEIVE') ?>

    <?php // echo $form->field($model, 'BUDGET_ACTUAL') ?>

    <?php // echo $form->field($model, 'PROJECT_STATUS') ?>

    <?php // echo $form->field($model, 'PROJ_HDLR_ID') ?>

    <?php // echo $form->field($model, 'CONTRACT_NUM') ?>

    <?php // echo $form->field($model, 'PLACE') ?>

    <?php // echo $form->field($model, 'AMPHOE_CODE') ?>

    <?php // echo $form->field($model, 'PROVINCE_CODE') ?>

    <?php // echo $form->field($model, 'PRINC_N_REASON') ?>

    <?php // echo $form->field($model, 'OBJECTIVE') ?>

    <?php // echo $form->field($model, 'TARGET') ?>

    <?php // echo $form->field($model, 'TARGET_GROUP') ?>

    <?php // echo $form->field($model, 'OUTPUT') ?>

    <?php // echo $form->field($model, 'INDICATOR') ?>

    <?php // echo $form->field($model, 'RESULT') ?>

    <?php // echo $form->field($model, 'SCOPE') ?>

    <?php // echo $form->field($model, 'PLAN') ?>

    <?php // echo $form->field($model, 'CREATE_BY') ?>

    <?php // echo $form->field($model, 'CREATE_DATE') ?>

    <?php // echo $form->field($model, 'LAST_UPD_BY') ?>

    <?php // echo $form->field($model, 'LAST_UPD_DATE') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
