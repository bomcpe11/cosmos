<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EfMenuSub */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ef-menu-sub-form">

    <?php $form = ActiveForm::begin(['id' => 'form-ef-menu-sub']); ?>

    <?= $form->field($model, 'MENU_MAIN_ID')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'MENU_SUB_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DESCRIPTION')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MENU_LINK')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SEQ')->textInput() ?>

    <?= $form->field($model, 'STATUS')->dropDownList(Yii::$app->params['statuses']) ?>

    <div class="form-group">
        <?= Html::button($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update') , ['class'=> $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id'=>'save-ef-menu-sub-button']) ; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php

$script = <<< JS
            
        $('#save-ef-menu-sub-button').click(function(){
                $.ajax( {   type:       'POST',
                            url:        $('#form-ef-menu-sub').attr('action') ,
                            data:       $('#form-ef-menu-sub').serialize() ,
                            success:    function( data ) {
                                                bootbox.alert('บันทึกข้อมูลสำเร็จ', function() {
                                                        window.parent.$.close_modal() ;     
                                                });
                                        },
                            error:      function (xhr, textStatus, error){
                                        },
                        }
                );                            
        }); 
                             
JS;

$this->registerJs($script) ;
?>