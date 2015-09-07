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
use kartik\date\DatePicker;

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
		<?php if ($mode == 'view') : ?>
			<div class="row">
				<div class="col-sm-offset-11 col-sm-1">
	    			<?= Html::a(Icon::show('edit', [], Icon::BSG), 
	    						['update', 'id' => $model->PROJECT_ID], 
	    						[
	    							'class' => 'btn btn-primary btn-sm center-block',
	    							'title' => 'แก้ไข'
	    						]) ?>
				</div>
			</div>
		<?php endif ?>
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
										'options' => [
											'placeholder' => 'กรุณาเลือก',
											'disabled' => ($mode == 'view')? true: false,
										],
										'pluginOptions' => [
											'allowClear' => false
										],
									]) ?>
								</div>
								<div class="col-md-6">
									<?= $form->field($model, 'PROJECT_TYPE_ID')->widget(Select2::classname(), [
										'data' => \yii\helpers\ArrayHelper::map(app\models\EfProjectType::find()->all(), 'PROJECT_TYPE_ID', 'PROJECT_TYPE_NAME'),
										'options' => [
											'placeholder' => 'กรุณาเลือก',
											'disabled' => ($mode == 'view')? true: false,
										],
										'pluginOptions' => [
											'allowClear' => false
										],
									]) ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<?= $form->field($model, 'PLAN_NAME')
												->textInput([
																'disabled' => ($mode == 'view')? true: false
															]) ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<?= $form->field($model, 'MAIN_PRODUCTIVITY')
												->textInput([
																'disabled' => ($mode == 'view')? true: false
															]) ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<?= $form->field($model, 'PROJECT_NAME')
												->textInput([
																'disabled' => ($mode == 'view')? true: false
															]) ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<?= $form->field($model, 'UNIT_ID')
									->widget(Select2::classname(), [
										'data' => \yii\helpers\ArrayHelper::map(app\models\EfUnit::find()->where(['UNIT_STATUS'=>'A'])->all(), 'UNIT_ID', 'UNIT_NAME'),
										'options' => [
											'placeholder' => 'กรุณาเลือก',
											'disabled' => ($mode == 'view')? true: false
										],
										'pluginOptions' => [
											'allowClear' => false
										],
									]) 
									?>
								</div>
								<div class="col-md-6">
									<?= $form->field($model, 'DIVISION_ID')->widget(DepDrop::classname(), [
										'data'=>  \yii\helpers\ArrayHelper::map(app\models\EfDivision::find()->where(['DIVISION_ID'=>$model->DIVISION_ID])->all(), 'DIVISION_ID', 'DIVISION_NAME'),
										'type' => DepDrop::TYPE_SELECT2,
										'select2Options' => [
											'pluginOptions' => [
												'allowClear' => false
											]
										],
										'options' => [
											'disabled' => ($mode == 'view')? true: false
										],
										'pluginOptions'=>[
											'depends'=> ($mode == 'view')? ['']: ['efproject-unit_id'],
											'initialize' => $model->isNewRecord?false:true,
											'url' => Url::to(['/common/ajax/get-efdivision-list']),
											'loadingText' => 'Loading ...',
											'placeholder'=>'เลือก สำนัก/กอง ก่อน'
										],
									])
									?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<?= $form->field($model, 'START_DATE')
												->widget(DatePicker::classname(),[
													    'type' => DatePicker::TYPE_COMPONENT_APPEND,
													    'value' => $model->START_DATE,
													    'disabled' => ($mode == 'view')? true: false,
													    'pluginOptions' => [
													        'autoclose'=>true,
													        'format' => 'yyyy-mm-dd'
													    ]
													]) ?>
								</div>
								<div class="col-md-6">
									<?= $form->field($model, 'END_DATE')
												->widget(DatePicker::classname(),[
													    'type' => DatePicker::TYPE_COMPONENT_APPEND,
													    'value' => $model->END_DATE,
													    'disabled' => ($mode == 'view')? true: false,
													    'pluginOptions' => [
													        'autoclose'=>true,
													        'format' => 'yyyy-mm-dd'
													    ]
													]) ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<?= $form->field($model, 'BUDGET_TYPE_ID')->widget(Select2::classname(), [
										'data' => \yii\helpers\ArrayHelper::map(app\models\EfBudgetType::find()->all(), 'BUDGET_TYPE_ID', 'BUDGET_TYPE_NAME'),
										'options' => [
											'placeholder' => 'กรุณาเลือก',
											'disabled' => ($mode == 'view')? true: false
										],
										'pluginOptions' => [
											'allowClear' => false
										],
									]) ?>
								</div>
								<div class="col-md-6">
									<?= $form->field($model, 'BUDGET_RECEIVE')
												->textInput([
																'disabled' => ($mode == 'view')? true: false
															]) ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<?= $form->field($model, 'BUDGET_ACTUAL')
												->textInput([
																'disabled' => ($mode == 'view')? true: false
															]) ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<?= $form->field($model, 'PROJECT_STATUS')
											->radioList(Yii::$app->params['projectStatuses'],
														[
														    'item' => function ($index, $label, $name, $checked, $value) use ($mode) {
														        return Html::radio($name, $checked, [
														            'value' => $value,
														            'label' => Html::encode($label),
														            'disabled' => ($mode == 'view')? true: false
														        ]);
														    },
														]); ?>
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
										'options' => [
														'placeholder' => 'กรุณาเลือก',
														'disabled' => ($mode == 'view')? true: false
													],
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
									<?= $form->field($model, 'CONTRACT_NUM')
												->textInput([
																'disabled' => ($mode == 'view')? true: false
															]) ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<?= $form->field($model, 'PLACE')
												->textInput([
																'disabled' => ($mode == 'view')? true: false
															]) ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<?= $form->field($model, 'PROVINCE_CODE')->widget(Select2::classname(), [
										'data' => \yii\helpers\ArrayHelper::map(app\models\EfThaiProvince::find()->all(), 'PROVINCE_ID', 'PROVINCE_NAME'),
										'options' => [
														'placeholder' => 'กรุณาเลือกจังหวัด',
														'disabled' => ($mode == 'view')? true: false
													],
										'pluginOptions' => [
											'allowClear' => false
										],
									]) ?>
								</div>
								<div class="col-md-6">
									<?=  $form->field($model, 'AMPHOE_CODE')->widget(DepDrop::classname(), [
										'data'=> \yii\helpers\ArrayHelper::map(app\models\EfThaiAmphur::find()->where(['AMPHUR_ID' => $model->AMPHOE_CODE])->all(), 'AMPHUR_ID', 'AMPHUR_NAME'),
										'type' => DepDrop::TYPE_SELECT2,
										'select2Options' => [
											'pluginOptions' => [
												'allowClear' => false
											]
										],
										'options' => [
											'disabled' => ($mode == 'view')? true: false
										],
										'pluginOptions'=>[
											'depends'=> ($mode == 'view')? ['']: ['efproject-province_code'],
											'initialize' => $model->isNewRecord?false:true,
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
															        'options' => ['rows' => 6, 'disabled' => ($mode == 'view')? true: false],
															        'preset' => 'basic'
															    ])->label(false),
									            'active' => true
									        ],
									        [
									            'label' => $model->getAttributeLabel('OBJECTIVE'),
									            'content' => $form->field($model, 'OBJECTIVE')->widget(CKEditor::className(), [
															        'options' => ['rows' => 6, 'disabled' => ($mode == 'view')? true: false],
															        'preset' => 'basic'
															    ])->label(false)
									        ],
									        [
									            'label' => $model->getAttributeLabel('TARGET'),
									            'content' => $form->field($model, 'TARGET')->widget(CKEditor::className(), [
															        'options' => ['rows' => 6, 'disabled' => ($mode == 'view')? true: false],
															        'preset' => 'basic'
															    ])->label(false)
									        ],
									        [
									            'label' => $model->getAttributeLabel('TARGET_GROUP'),
									            'content' => $form->field($model, 'TARGET_GROUP')->widget(CKEditor::className(), [
															        'options' => ['rows' => 6, 'disabled' => ($mode == 'view')? true: false],
															        'preset' => 'basic'
															    ])->label(false)
									        ],
									        [
									            'label' => $model->getAttributeLabel('OUTPUT'),
									            'content' => $form->field($model, 'OUTPUT')->widget(CKEditor::className(), [
															        'options' => ['rows' => 6, 'disabled' => ($mode == 'view')? true: false],
															        'preset' => 'basic'
															    ])->label(false)
									        ],
									        [
									            'label' => $model->getAttributeLabel('INDICATOR'),
									            'content' => $form->field($model, 'INDICATOR')->widget(CKEditor::className(), [
															        'options' => ['rows' => 6, 'disabled' => ($mode == 'view')? true: false],
															        'preset' => 'basic'
															    ])->label(false)
									        ],
									        [
									            'label' => $model->getAttributeLabel('RESULT'),
									            'content' => $form->field($model, 'RESULT')->widget(CKEditor::className(), [
															        'options' => ['rows' => 6, 'disabled' => ($mode == 'view')? true: false],
															        'preset' => 'basic'
															    ])->label(false)
									        ],
									        [
									            'label' => $model->getAttributeLabel('SCOPE'),
									            'content' => $form->field($model, 'SCOPE')->widget(CKEditor::className(), [
															        'options' => ['rows' => 6, 'disabled' => ($mode == 'view')? true: false],
															        'preset' => 'basic'
															    ])->label(false)
									        ],
									        [
									            'label' => $model->getAttributeLabel('PLAN'),
									            'content' => $form->field($model, 'PLAN')->widget(CKEditor::className(), [
															        'options' => ['rows' => 6, 'disabled' => ($mode == 'view')? true: false],
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
														'multiple' => true,
														'disabled' => ($mode == 'view')? true: false
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
													    'allowedFileExtensions' => $documentUploadForm->getAllowedFileExtensions(),
													    'allowedPreviewTypes' => false,
													    'previewFileIcon' => Icon::show('file'),
													    'previewFileIconSettings' => [
													        'doc' => $documentUploadForm->getIcon('doc'),
													        'docx' => $documentUploadForm->getIcon('docx'),
													        'xls' => $documentUploadForm->getIcon('xls'),
													        'xlsx' => $documentUploadForm->getIcon('xlsx'),
													        'ppt' => $documentUploadForm->getIcon('ppt'),
													        'pptx' => $documentUploadForm->getIcon('pptx'),
													        'pdf' => $documentUploadForm->getIcon('pdf'),
													        'txt' => $documentUploadForm->getIcon('txt'),
													    ],
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
									echo $form->field($imageUploadForm, 'file')
												->widget(FileInput::classname(), [
													'disabled' => ($model->PROJECT_ID == null)? true: false,
													'options' => [
														'class' => 'document-upload-input',
														'multiple' => true,
														'disabled' => ($mode == 'view')? true: false
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

	<?php if ($mode != 'view'): ?>
	    <div class="form-group" style="text-align:center;">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php endif ?>

    <?php ActiveForm::end(); ?>

</div>
<?php
$js = <<<JS
JS;

$this->registerJs($js);
?>