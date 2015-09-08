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

$this->title = Yii::t('user', 'Create {modelClass}', [
  'modelClass' => 'User',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <?= $this->render('_form', [
        'user' => $user,
    	'profile' => $profile,
    	'ef_proj_hdlr' => $ef_proj_hdlr,
    	'provinces' => $provinces
    ]) ?>
    
</div>