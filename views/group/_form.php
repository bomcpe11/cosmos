<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EfGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ef-group-form">
	
	<?php 
		if($model->isNewRecord){
			$model->STATUS='A';
		}
	?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'GROUP_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STATUS')->dropDownList(Yii::$app->params['statuses']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
