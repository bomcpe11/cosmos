<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EfProjectPlanAct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ef-project-plan-act-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'PROJECT_PLAN_ACT_ID')->textInput() ?>

    <?= $form->field($model, 'PLAN_ACT_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SEQ')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BUDGET_PLAN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LEVEL')->textInput() ?>

    <?= $form->field($model, 'PARENT_ID')->textInput() ?>

    <?= $form->field($model, 'PROJECT_ID')->textInput() ?>

    <?= $form->field($model, 'STATUS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_BY')->textInput() ?>

    <?= $form->field($model, 'CREATE_DATE')->textInput() ?>

    <?= $form->field($model, 'LAST_UPD_BY')->textInput() ?>

    <?= $form->field($model, 'LAST_UPD_DATE')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
