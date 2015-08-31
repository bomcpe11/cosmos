<?php

use yii\helpers\Html;

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use kartik\widgets\Select2;
use dosamigos\ckeditor\CKEditor;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model app\models\EfProject */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
	.form-horizontal .control-label{
		text-align: left;
	}
	.form-horizontal .radio {
	    float: left;
	    padding-left: 13px;
    }
</style>

<div class="ef-project-form">

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
				<div class="">
					<div class="panel panel-success dummy-data">
						<div class="panel-heading">
							<h3 class="panel-title">โครงการที่ได้รับการสนับสนุนจากกองทุนสิ่งแวดล้อม</h3>
						</div>
						<div class="panel-body search-result-contents">
							<div class="row">
								<div class="col-md-6">
									<?= $form->field($model, 'FISCAL_YEAR')->widget(Select2::classname(), [
										'data' => ['2558', '2557', '2556'],
										'options' => ['placeholder' => 'กรุณาเลือก'],
										'pluginOptions' => [
											'allowClear' => false
										],
									]) ?>
								</div>
								<div class="col-md-6">
									<?= $form->field($model, 'PROJECT_TYPE_ID') ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<?= $form->field($model, 'PLAN_NAME') ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<?= $form->field($model, 'MAIN_PRODUCTIVITY') ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<?= $form->field($model, 'PROJECT_NAME') ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<?= $form->field($model, 'UNIT_ID')
									->widget(Select2::classname(), [
										'data' => \yii\helpers\ArrayHelper::map(app\models\EfUnit::find()->where(['UNIT_STATUS'=>'A'])->all(), 'UNIT_ID', 'UNIT_NAME'),
										'options' => ['placeholder' => 'กรุณาเลือก'],
										'pluginOptions' => [
											'allowClear' => false
										],
									]) 
									?>
								</div>
								<div class="col-md-6">
									<?= $form->field($model, 'DIVISION_ID')->widget(DepDrop::classname(), [
										'data'=> [$model->DIVISION_ID=>''],
										'type' => DepDrop::TYPE_SELECT2,
										'select2Options' => [
											'pluginOptions' => [
												'allowClear' => false
											]
										],
										'pluginOptions'=>[
											'depends'=>['efproject-unit_id'],
											'initialize' => true,
        									'initDepends'=>['efproject-unit_id'],
											'url' => Url::to(['/common/ajax/get-efdivision-list']),
											'loadingText' => 'Loading ...',
											'placeholder'=>'เลือก สำนัก/กอง ก่อน'
										]
									])
									?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									
								</div>
								<div class="col-md-4">
									<?= $form->field($model, 'START_DATE') ?>
								</div>
								<div class="col-md-2">
									<?= $form->field($model, 'END_DATE') ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<?= $form->field($model, 'BUDGET_TYPE_ID')->widget(Select2::classname(), [
										'data' => [],
										'options' => ['placeholder' => 'กรุณาเลือก'],
										'pluginOptions' => [
											'allowClear' => false
										],
									]) ?>
								</div>
								<div class="col-md-6">
									<?= $form->field($model, 'BUDGET_RECEIVE') ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<?= $form->field($model, 'BUDGET_ACTUAL') ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<?= $form->field($model, 'PROJECT_STATUS')->radioList([1=>'อยู่ระหว่างดำเนินการ',2=>'ดำเนินการเสร็จสิ้น',3=>'ยกเลิกโครงการ']); ?>
							    </div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="">
					<div class="panel panel-danger dummy-data">
						<div class="panel-heading">
							<h3 class="panel-title">ผู้รับกองทุน</h3>
						</div>
						<div class="panel-body search-result-contents">
							<div class="row">
								<div class="col-md-6">
									<?= $form->field($model, 'FISCAL_YEAR')->passwordInput() ?>
								</div>
								<div class="col-md-6">
									<?= $form->field($model, 'PROJECT_TYPE_ID')->passwordInput() ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="">
					<div class="panel panel-primary dummy-data">
						<div class="panel-heading">
							<h3 class="panel-title">รายละเอียดโครงการ</h3>
						</div>
						<div class="panel-body search-result-contents">
							<div class="row">
								<div class="col-md-12">
									<?= Tabs::widget([
									    'items' => [
									        [
									            'label' => $model->getAttributeLabel('PRINC_N_REASON'),
									            'content' => $form->field($model, 'PRINC_N_REASON')->widget(CKEditor::className(), [
															        'options' => ['rows' => 6],
															        'preset' => 'basic'
															    ])->label(false),
									            'active' => true
									        ],
									        [
									            'label' => $model->getAttributeLabel('OBJECTIVE'),
									            'content' => $form->field($model, 'OBJECTIVE')->widget(CKEditor::className(), [
															        'options' => ['rows' => 6],
															        'preset' => 'basic'
															    ])->label(false)
									        ],
									    ],
									]);?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="">
					<div class="panel panel-warning dummy-data">
						<div class="panel-heading">
							<h3 class="panel-title">เอกสารแนบ</h3>
						</div>
						<div class="panel-body search-result-contents">
							<div class="row">
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="">
					<div class="panel panel-danger dummy-data">
						<div class="panel-heading">
							<h3 class="panel-title">ภาพประกอบโครงการ</h3>
						</div>
						<div class="panel-body search-result-contents">
							<div class="row">
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
