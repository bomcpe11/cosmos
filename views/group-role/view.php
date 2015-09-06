<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EfGroupRole */

$this->title = $model->GROUP_ROLE_ID;
$this->params['breadcrumbs'][] = ['label' => 'Ef Group Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ef-group-role-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->GROUP_ROLE_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->GROUP_ROLE_ID], [
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
            'GROUP_ROLE_ID',
            'GROUP_ID',
            'MENU_SUB_ID',
            'ACCESS_FLAG',
            'ADD_FLAG',
            'EDIT_FLAG',
            'DELETE_FLAG',
            'CREATE_BY',
            'CREATE_DATE',
            'LAST_UPD_BY',
            'LAST_UPD_DATE',
        ],
    ]) ?>

</div>
