<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EfMenuMain */

$this->title = $model->MENU_MAIN_ID;
$this->params['breadcrumbs'][] = ['label' => 'Ef Menu Mains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ef-menu-main-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->MENU_MAIN_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->MENU_MAIN_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'MENU_MAIN_ID',
            'MENU_MAIN_NAME',
            'DESCRIPTION',
            'SEQ',
            'STATUS',
            'CREATE_BY',
            'CREATE_DATE',
            'LAST_UPD_BY',
            'LAST_UPD_DATE',
        ],
    ]) ?>

</div>
