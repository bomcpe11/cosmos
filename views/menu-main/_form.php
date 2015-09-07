<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EfMenuMain */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ef-menu-main-form">

    <?php $form = ActiveForm::begin(['id' => 'form-ef-menu-main']); ?>

    <?= $form->field($model, 'MENU_MAIN_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DESCRIPTION')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SEQ')->textInput() ?>

    <?= $form->field($model, 'STATUS')->dropDownList(Yii::$app->params['statuses']) ?>

    <div class="form-group">
        <?= Html::button($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update') , ['class'=> $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id'=>'save-ef-menu-main-button']) ; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$script = <<< JS
            
        $('#save-ef-menu-main-button').click(function(){
                $.ajax( {   type:       'POST',
                            url:        $('#form-ef-menu-main').attr('action') ,
                            data:       $('#form-ef-menu-main').serialize() ,
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