<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use kartik\widgets\Select2;

$role = Yii::$app->getModule("user")->model("Role");

/**
 * @var yii\web\View $this
 * @var amnah\yii2\user\models\User $user
 * @var amnah\yii2\user\models\Profile $profile
 * @var yii\widgets\ActiveForm $form
 */
?>
<style type="text/css">
	.form-horizontal .control-label{
		text-align: left;
	}
</style>
<div class="user-form">

	<?php
		$form = ActiveForm::begin([
			'method' => 'post',
			'layout' => 'horizontal',
			'fieldConfig' => [
			'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
			'horizontalCssClasses' => [
										'offset' => '',
										'label' => 'col-md-12',
										'wrapper' => 'col-md-12',
										'error' => '',
										'hint' => '',
									],
			]
		]);
	?>
	
	<div class="row content">
		<div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="panel panel-success dummy-data">
						<div class="panel-heading bg-olive">
							<h3 class="panel-title">ชื่อผู้ใช้งานระบบ</h3>
						</div>
						<div class="panel-body search-result-contents">
							<div class="row">
								<div class="col-md-6">
								<?= $form->field($user, 'username') ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<?= $form->field($user, 'newPassword')->passwordInput() ?>
								</div>
								<div class="col-md-6">
									<?= $form->field($user, 'newPasswordConfirm')->passwordInput() ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="panel panel-danger dummy-data">
						<div class="panel-heading bg-red">
							<h3 class="panel-title">ผู้รับผิดชอบโครงการ</h3>
						</div>
						<div class="panel-body search-result-contents">
							<div class="row">
								<div class="col-md-6">
									<?= $form->field($ef_proj_hdlr, 'RESP_FIRST_NAME') ?>
								</div>
								<div class="col-md-6">
									<?= $form->field($ef_proj_hdlr, 'RESP_LAST_NAME') ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<?= $form->field($ef_proj_hdlr, 'RESP_ID_NO') ?>
								</div>
							</div><div class="row">
								<div class="col-md-6">
									<?= $form->field($ef_proj_hdlr, 'RESP_MOBILE_NO') ?>
								</div>
								<div class="col-md-6">
									<?= $form->field($ef_proj_hdlr, 'RESP_EMAIL') ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="">
					<div class="panel panel-warning dummy-data">
						<div class="panel-heading bg-orange">
							<h3 class="panel-title">หน่วยงานที่รับผิดชอบโครงการ</h3>
						</div>
						<div class="panel-body search-result-contents">
							<div class="row">
								<div class="col-md-12">
									<?= $form->field($ef_proj_hdlr, 'NAME') ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<?= $form->field($ef_proj_hdlr, 'ADDRESS_NO') ?>
								</div>
								<div class="col-md-6">
									<?= $form->field($ef_proj_hdlr, 'VILLAGE_NO') ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<?= $form->field($ef_proj_hdlr, 'ROAD') ?>
								</div>
								<div class="col-md-6">
	
									<?=  $form->field($ef_proj_hdlr, 'TAMBOL_CODE')->widget(DepDrop::classname(), [
										'data'=> [$ef_proj_hdlr->TAMBOL_CODE=>''],
										'type' => DepDrop::TYPE_SELECT2,
										'select2Options' => [
											'pluginOptions' => [
												'allowClear' => false
											]
										],
										'pluginOptions'=>[
											'depends'=>['efprojhdlr-amphoe_code'],
											'initialize' => true,
        									'initDepends'=>['efprojhdlr-amphoe_code'],
											'url' => Url::to(['/common/ajax/get-district-list']),
											'loadingText' => 'Loading ...',
											'placeholder'=>'เลือกจังหวัดและอำเภอก่อน'
										]
									]) ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
	
									<?=  $form->field($ef_proj_hdlr, 'AMPHOE_CODE')->widget(DepDrop::classname(), [
										'data'=> [$ef_proj_hdlr->AMPHOE_CODE=>''],
										'type' => DepDrop::TYPE_SELECT2,
										'select2Options' => [
											'pluginOptions' => [
												'allowClear' => false
											]
										],
										'pluginOptions'=>[
											'depends'=>['efprojhdlr-province_code'],
											'initialize' => true,
        									'initDepends'=>['efprojhdlr-province_code'],
											'url' => Url::to(['/common/ajax/get-amphur-list']),
											'loadingText' => 'Loading ...',
											'placeholder'=>'เลือกจังหวัดก่อน'
										]
									]) ?>
								</div>
								<div class="col-md-6">
									<?= $form->field($ef_proj_hdlr, 'PROVINCE_CODE')->widget(Select2::classname(), [
										'data' => \yii\helpers\ArrayHelper::map($provinces, 'PROVINCE_ID', 'PROVINCE_NAME'),
										'options' => ['placeholder' => 'กรุณาเลือกจังหวัด'],
										'pluginOptions' => [
											'allowClear' => false
										],
									]) ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<?= $form->field($ef_proj_hdlr, 'ZIP_CODE') ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<?= $form->field($ef_proj_hdlr, 'TELEPHONE_NO') ?>
								</div>
								<div class="col-md-6">
									<?= $form->field($ef_proj_hdlr, 'FAX_NO') ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<?= $form->field($ef_proj_hdlr, 'EMAIL') ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-offset-5 col-md-7">
		<?= Html::submitButton($user->isNewRecord ? Yii::t('user', 'Create') : Yii::t('user', 'Update'), ['class' => $user->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Reset',
					Url::to(['staticdata-countrys/index']),
					['class' => 'btn btn-danger']) ?>
	</div>
	
	<?php ActiveForm::end(); ?>

</div>
