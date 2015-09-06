<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EfProjectPlanActSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ef-project-plan-act-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'PROJECT_PLAN_ACT_ID') ?>

    <?= $form->field($model, 'PLAN_ACT_NAME') ?>

    <?= $form->field($model, 'SEQ') ?>

    <?= $form->field($model, 'BUDGET_PLAN') ?>

    <?= $form->field($model, 'LEVEL') ?>

    <?php // echo $form->field($model, 'PARENT_ID') ?>

    <?php // echo $form->field($model, 'PROJECT_ID') ?>

    <?php // echo $form->field($model, 'STATUS') ?>

    <?php // echo $form->field($model, 'CREATE_BY') ?>

    <?php // echo $form->field($model, 'CREATE_DATE') ?>

    <?php // echo $form->field($model, 'LAST_UPD_BY') ?>

    <?php // echo $form->field($model, 'LAST_UPD_DATE') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
