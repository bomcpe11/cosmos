<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EfMenuSubSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ef-menu-sub-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'MENU_SUB_ID') ?>

    <?= $form->field($model, 'MENU_MAIN_ID') ?>

    <?= $form->field($model, 'MENU_SUB_NAME') ?>

    <?= $form->field($model, 'DESCRIPTION') ?>

    <?= $form->field($model, 'MENU_LINK') ?>

    <?php // echo $form->field($model, 'SEQ') ?>

    <?php // echo $form->field($model, 'STATUS') ?>

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
