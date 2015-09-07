<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EfProject */

$this->title = 'Update Ef Project: ' . ' ' . $model->PROJECT_ID;
$this->params['breadcrumbs'][] = ['label' => 'Ef Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PROJECT_ID, 'url' => ['view', 'id' => $model->PROJECT_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ef-project-update">

    <?= $this->render('_form', [
        'model' => $model,
        'mode' => $mode,
        'documentUploadForm' => $documentUploadForm,
        'documentUploadFormConfigs' => $documentUploadFormConfigs,
        'imageUploadForm' => $imageUploadForm,
        'imageUploadFormConfigs' => $imageUploadFormConfigs
    ]) ?>

</div>
