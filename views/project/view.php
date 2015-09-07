<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EfProject */

$this->title = 'View Ef Project: ' . ' ' . $model->PROJECT_NAME;
$this->params['breadcrumbs'][] = ['label' => 'Ef Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ef-project-view">
    <?= $this->render('_form', [
        'model' => $model,
        'mode' => $mode,
        'documentUploadForm' => $documentUploadForm,
        'documentUploadFormConfigs' => $documentUploadFormConfigs,
        'imageUploadForm' => $imageUploadForm,
        'imageUploadFormConfigs' => $imageUploadFormConfigs
    ]) ?>

</div>
