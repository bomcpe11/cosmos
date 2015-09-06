<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EfGroupUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ef-group-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'GROUP_USER_ID')->textInput() ?>

    <?= $form->field($model, 'GROUP_ID')->textInput() ?>

    <?= $form->field($model, 'USER_ID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
