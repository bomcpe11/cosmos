<?php

use yii\helpers\Html;

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Json;
use kartik\widgets\DepDrop;
use kartik\widgets\Select2;
use dosamigos\ckeditor\CKEditor;
use yii\bootstrap\Tabs;
use kartik\widgets\FileInput;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model app\models\EfProject */
/* @var $form yii\widgets\ActiveForm */

// test commit
?>
<style type="text/css">
	.form-horizontal .control-label{
		text-align: left;
	}
	.form-horizontal .radio {
	    float: left;
	    padding-left: 13px;
    }
    .docs-icon{
    	font-size: 66px;
    	color: gray;
    	padding: 60px;
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
										'data' => ['2558'=>'2558', '2557'=>'2557', '2556'=>'2556'],
										'options' => ['placeholder' => 'กรุณาเลือก'],
										'pluginOptions' => [
											'allowClear' => false
										],
									]) ?>
								</div>
								<div class="col-md-6">
									<?= $form->field($model, 'PROJECT_TYPE_ID')->widget(Select2::classname(), [
										'data' => \yii\helpers\ArrayHelper::map(app\models\EfProjectType::find()->all(), 'PROJECT_TYPE_ID', 'PROJECT_TYPE_NAME'),
										'options' => ['placeholder' => 'กรุณาเลือก'],
										'pluginOptions' => [
											'allowClear' => false
										],
									]) ?>
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
											'initialize' => $model->isNewRecord?false:true,
        									'initDepends'=> ['efproject-unit_id'],
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
										'data' => \yii\helpers\ArrayHelper::map(app\models\EfBudgetType::find()->all(), 'BUDGET_TYPE_ID', 'BUDGET_TYPE_NAME'),
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
								<div class="col-md-12">
									<?= $form->field($model, 'PROJ_HDLR_ID')->widget(Select2::classname(), [
										'data' => \yii\helpers\ArrayHelper::map(app\models\EfProjHdlr::find()->all(), 'PROJ_HDLR_ID', 'NAME'),
										'options' => ['placeholder' => 'กรุณาเลือก'],
										'pluginOptions' => [
											'allowClear' => false
										],
									]) ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									
								</div>
								<div class="col-md-6">
									
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<?= $form->field($model, 'CONTRACT_NUM') ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<?= $form->field($model, 'PLACE') ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<?= $form->field($model, 'PROVINCE_CODE')->widget(Select2::classname(), [
										'data' => \yii\helpers\ArrayHelper::map(app\models\EfThaiProvince::find()->all(), 'PROVINCE_ID', 'PROVINCE_NAME'),
										'options' => ['placeholder' => 'กรุณาเลือกจังหวัด'],
										'pluginOptions' => [
											'allowClear' => false
										],
									]) ?>
								</div>
								<div class="col-md-6">
									<?=  $form->field($model, 'AMPHOE_CODE')->widget(DepDrop::classname(), [
										'data'=> [$model->AMPHOE_CODE=>''],
										'type' => DepDrop::TYPE_SELECT2,
										'select2Options' => [
											'pluginOptions' => [
												'allowClear' => false
											]
										],
										'pluginOptions'=>[
											'depends'=>['efproject-province_code'],
											'initialize' => $model->isNewRecord?false:true,
        									'initDepends'=>['efproject-province_code'],
											'url' => Url::to(['/common/ajax/get-amphur-list']),
											'loadingText' => 'Loading ...',
											'placeholder'=>'เลือกจังหวัดก่อน'
										]
									]) ?>
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
									        [
									            'label' => $model->getAttributeLabel('TARGET'),
									            'content' => $form->field($model, 'TARGET')->widget(CKEditor::className(), [
															        'options' => ['rows' => 6],
															        'preset' => 'basic'
															    ])->label(false)
									        ],
									        [
									            'label' => $model->getAttributeLabel('TARGET_GROUP'),
									            'content' => $form->field($model, 'TARGET_GROUP')->widget(CKEditor::className(), [
															        'options' => ['rows' => 6],
															        'preset' => 'basic'
															    ])->label(false)
									        ],
									        [
									            'label' => $model->getAttributeLabel('OUTPUT'),
									            'content' => $form->field($model, 'OUTPUT')->widget(CKEditor::className(), [
															        'options' => ['rows' => 6],
															        'preset' => 'basic'
															    ])->label(false)
									        ],
									        [
									            'label' => $model->getAttributeLabel('INDICATOR'),
									            'content' => $form->field($model, 'INDICATOR')->widget(CKEditor::className(), [
															        'options' => ['rows' => 6],
															        'preset' => 'basic'
															    ])->label(false)
									        ],
									        [
									            'label' => $model->getAttributeLabel('RESULT'),
									            'content' => $form->field($model, 'RESULT')->widget(CKEditor::className(), [
															        'options' => ['rows' => 6],
															        'preset' => 'basic'
															    ])->label(false)
									        ],
									        [
									            'label' => $model->getAttributeLabel('SCOPE'),
									            'content' => $form->field($model, 'SCOPE')->widget(CKEditor::className(), [
															        'options' => ['rows' => 6],
															        'preset' => 'basic'
															    ])->label(false)
									        ],
									        [
									            'label' => $model->getAttributeLabel('PLAN'),
									            'content' => $form->field($model, 'PLAN')->widget(CKEditor::className(), [
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
								<?php 
									echo $form->field($documentUploadForm, 'file')
												->widget(FileInput::classname(), [
													'disabled' => ($model->PROJECT_ID == null)? true: false,
													'options' => [
														'class' => 'document-upload-input',
														'multiple' => true
													],
													'pluginOptions' => [
														'uploadUrl' =>  Url::to(["document-upload"]),
													    'uploadAsync' => true,
													    'minFileCount' => 1,
													    'maxFileCount' => 5,
													    'overwriteInitial' => false,
													    'initialPreview' => isset($documentUploadFormConfigs['initialPreview'])
																				? $documentUploadFormConfigs['initialPreview']
																				: [],
													    'initialPreviewConfig' => isset($documentUploadFormConfigs['initialPreviewConfig'])
																				? $documentUploadFormConfigs['initialPreviewConfig']
																				: [],
													    'uploadExtraData' => [
													       'project_id' => $model->PROJECT_ID,
													    ],
													    'allowedFileExtensions' => ['docx', 'xlsx', 'pptx', 'pdf'],
													    'allowedPreviewTypes' => false,
													    'previewFileIcon' => Icon::show('file'),
													    'previewFileIconSettings' => [
													        'docx' => Icon::show('file-word-o', ['class' => 'text-primary']),
													        'xlsx' => Icon::show('file-excel-o', ['class' => 'text-success']),
													        'pptx' => Icon::show('file-powerpoint-o', ['class' => 'text-danger']),
													        'pdf' => Icon::show('file-pdf-o', ['class' => 'text-danger']),
													    ]
													],
													'pluginEvents' => [
														'filepredelete' => "function(event, key) {
											                return (!confirm('Are you sure you want to delete ?'));
											            }",
													]
												])->label(false);
								?>
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
								<?php 
									// Display an initial preview of files with caption
									// (useful in UPDATE scenarios). Set overwrite `initialPreview`
									// to `false` to append uploaded images to the initial preview.
									// echo FileInput::widget([
									// 	'name' => 'PROJECT_IMAGE',
									// 	'disabled' => ($model->PROJECT_ID == null)? true: false,
									// 	'options'=>[
									// 		'multiple'=>true
									// 	],
									// 	'pluginOptions' => [
									// 		'initialPreview'=>[
									// 			Html::img("@web/images/DSC_0063-1.jpg", ['class'=>'file-preview-image', 'alt'=>'DSC_0063-1.jpg', 'title'=>'DSC_0063-1.jpg']),
									// 			Html::img("@web/images/teamwork-penguin.png",  ['class'=>'file-preview-image', 'alt'=>'teamwork-penguin.png', 'title'=>'teamwork-penguin.png']),
									// 		],
        	// 								'overwriteInitial'=>false
									// 	]
									// 	]);
									echo $form->field($imageUploadForm, 'file')
												->widget(FileInput::classname(), [
													'disabled' => ($model->PROJECT_ID == null)? true: false,
													'options' => [
														'class' => 'document-upload-input',
														'multiple' => true
													],
													'pluginOptions' => [
														'uploadUrl' =>  Url::to(["image-upload"]),
													    'uploadAsync' => true,
													    'minFileCount' => 1,
													    'maxFileCount' => 5,
													    'overwriteInitial' => false,
													    'initialPreview' => isset($imageUploadFormConfigs['initialPreview'])
																				? $imageUploadFormConfigs['initialPreview']
																				: [],
													    'initialPreviewConfig' => isset($imageUploadFormConfigs['initialPreviewConfig'])
																				? $imageUploadFormConfigs['initialPreviewConfig']
																				: [],
													    'uploadExtraData' => [
													       'project_id' => $model->PROJECT_ID,
													    ],
													    'allowedFileExtensions' => ['jpg', 'gif', 'png',],
													],
													'pluginEvents' => [
														'filepredelete' => "function(event, key) {
											                return (!confirm('Are you sure you want to delete ?'));
											            }",
													]
												])->label(false);
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div class="form-group" style="text-align:center;">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
	$this->registerJsFile(Yii::$app->request->baseUrl.'/js/views/project/form.js', 
						[
							'depends' => [
								\yii\web\JqueryAsset::className()
							]
						]);
?>