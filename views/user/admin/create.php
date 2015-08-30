<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
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
<div class="user-create">

	<h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'user' => $user,
    	'profile' => $profile,
    	'ef_proj_hdlr' => $ef_proj_hdlr,
    	'provinces' => $provinces
    ]) ?>
    
</div>