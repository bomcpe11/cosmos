<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\widgets\Select2;

/**
 * @var yii\web\View $this
 * @var amnah\yii2\user\models\User $user
 * @var amnah\yii2\user\models\Profile $profile
 */

?>
<style type="text/css">
@media (min-width: 992px){
	
}
.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12{
/* 	float: none; */
}
</style>
<?
$this->title = Yii::t('user', 'Create {modelClass}', [
  'modelClass' => 'User',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
	$form = ActiveForm::begin([
		'action' => ['articles/importer'],
		'method' => 'post',
		'layout' => 'horizontal',
		'fieldConfig' => [
		'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
		'horizontalCssClasses' => [
									'offset' => '',
									'label' => 'col-md-2',
									'wrapper' => 'col-md-10',
									'error' => '',
									'hint' => '',
								],
// 		'fieldConfig'=>['class'=>'col-md-12'],
		]
	]);
// 	$form->field->labelOptions = ['class'=>'col-md-12'];
?>

<div class="row content">
	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="panel panel-success dummy-data">
					<div class="panel-heading">
						<h3 class="panel-title">ชื่อผู้ใช้งานระบบ</h3>
					</div>
					<div class="panel-body search-result-contents">
						<div class="row">
							<div class="col-md-6">
							<?= $form->field($user, 'username')->label(null, ['class'=>'col-md-12']) ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<?= $form->field($user, 'newPassword')->passwordInput()->label(null, ['class'=>'col-md-12']) ?>
							</div>
							<div class="col-md-5">
								<label for="confirmPassword">ยืนยันรหัสผ่าน</label>
								<?= Html::passwordInput('confirmPassword', '', ['id'=>'confirmPassword', 'class' => 'form-control col-md-12']) ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="panel panel-danger dummy-data">
					<div class="panel-heading">
						<h3 class="panel-title">ผู้รับผิดชอบโครงการ</h3>
					</div>
					<div class="panel-body search-result-contents">
						<div class="row">
							<div class="col-md-6">
								<?= $form->field($ef_proj_hdlr, 'RESP_FIRST_NAME')->label(null, ['class'=>'col-md-12']) ?>
							</div>
							<div class="col-md-6">
								<?= $form->field($ef_proj_hdlr, 'RESP_LAST_NAME')->label(null, ['class'=>'col-md-12']) ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<?= $form->field($ef_proj_hdlr, 'RESP_ID_NO')->label(null, ['class'=>'col-md-12']) ?>
							</div>
						</div><div class="row">
							<div class="col-md-6">
								<?= $form->field($ef_proj_hdlr, 'RESP_MOBILE_NO')->label(null, ['class'=>'col-md-12']) ?>
							</div>
							<div class="col-md-6">
								<?= $form->field($ef_proj_hdlr, 'RESP_EMAIL')->label(null, ['class'=>'col-md-12']) ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="">
				<div class="panel panel-warning dummy-data">
					<div class="panel-heading">
						<h3 class="panel-title">หน่วยงานที่รับผิดชอบโครงการ</h3>
					</div>
					<div class="panel-body search-result-contents">
						<div class="row">
							<div class="col-md-12">
								<?= $form->field($ef_proj_hdlr, 'NAME')->label(null, ['class'=>'col-md-12']) ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<?= $form->field($ef_proj_hdlr, 'ADDRESS_NO')->label(null, ['class'=>'col-md-12']) ?>
							</div>
							<div class="col-md-6">
								<?= $form->field($ef_proj_hdlr, 'VILLAGE_NO')->label(null, ['class'=>'col-md-12']) ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<?= $form->field($ef_proj_hdlr, 'ROAD')->label(null, ['class'=>'col-md-12']) ?>
							</div>
							<div class="col-md-6">
								<?= $form->field($ef_proj_hdlr, 'TAMBOL_CODE')->widget(Select2::classname(), [
								    'data' => [],
								    'options' => ['placeholder' => 'เลือกจังหวัดและอำเภอก่อน'],
								    'pluginOptions' => [
								        'allowClear' => false
								    ],
								])->label(null, ['class'=>'col-md-12']) ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<?php 
									$amphoe_list_url = \yii\helpers\Url::to(['common/ajax/amphoe-list']);
								?>
								<?= $form->field($ef_proj_hdlr, 'AMPHOE_CODE')->widget(Select2::classname(), [
								    'data' => [],
								    'options' => ['placeholder' => 'เลือกจังหวัดก่อน'],
								    'pluginOptions' => [
								        'allowClear' => false,
							    		'ajax' => [
							    				'url' => $url,
							    				'dataType' => 'json',
							    				'data' => new JsExpression('function(params) { return {q:params.term}; }')
							    		],
							    		'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
							    		'templateResult' => new JsExpression('function(city) { return city.text; }'),
							    		'templateSelection' => new JsExpression('function (city) { return city.text; }'),
								    ],
								])->label(null, ['class'=>'col-md-12']) ?>
							</div>
							<div class="col-md-6">
								<?= $form->field($ef_proj_hdlr, 'PROVINCE_CODE')->widget(Select2::classname(), [
								    'data' => \yii\helpers\ArrayHelper::map($provinces, 'PROVINCE_ID', 'PROVINCE_NAME'),
								    'options' => ['placeholder' => 'กรุณาเลือกจังหวัด'],
								    'pluginOptions' => [
								        'allowClear' => false
								    ],
								])->label(null, ['class'=>'col-md-12']) ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<?= $form->field($ef_proj_hdlr, 'ZIP_CODE')->label(null, ['class'=>'col-md-12']) ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<?= $form->field($ef_proj_hdlr, 'TELEPHONE_NO')->label(null, ['class'=>'col-md-12']) ?>
							</div>
							<div class="col-md-6">
								<?= $form->field($ef_proj_hdlr, 'FAX_NO')->label(null, ['class'=>'col-md-12']) ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<?= $form->field($ef_proj_hdlr, 'EMAIL')->label(null, ['class'=>'col-md-12']) ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-md-offset-5 col-md-7">
	<?= Html::submitButton('<span class="glyphicon glyphicon-save" aria-hidden="true"></span> Save',
							['class' => 'btn btn-primary']) ?>
	<?= Html::a('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Reset',
				Url::to(['staticdata-countrys/index']),
				['class' => 'btn btn-danger']) ?>
</div>

<?php ActiveForm::end(); ?>
		
<!--div class="user-create">

    <h1><?php 
//     echo Html::encode($this->title) 
    ?></h1>

    <?php 
//     echo $this->render('_form', [
//         'user' => $user,
//         'profile' => $profile
//     ]) 
    ?>
</div-->