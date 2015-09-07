<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EfGroupRole */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ef-group-role-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'GROUP_ROLE_ID')->textInput() ?>

    <?= $form->field($model, 'GROUP_ID')->textInput() ?>

    <?= $form->field($model, 'MENU_SUB_ID')->textInput() ?>

    <?= $form->field($model, 'ACCESS_FLAG')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ADD_FLAG')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EDIT_FLAG')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DELETE_FLAG')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
