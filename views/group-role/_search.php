<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EfGroupRoleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ef-group-role-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'GROUP_ROLE_ID') ?>

    <?= $form->field($model, 'GROUP_ID') ?>

    <?= $form->field($model, 'MENU_SUB_ID') ?>

    <?= $form->field($model, 'ACCESS_FLAG') ?>

    <?= $form->field($model, 'ADD_FLAG') ?>

    <?php // echo $form->field($model, 'EDIT_FLAG') ?>

    <?php // echo $form->field($model, 'DELETE_FLAG') ?>

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
