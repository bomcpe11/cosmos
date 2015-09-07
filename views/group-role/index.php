<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EfGroupRoleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ef Group Roles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ef-group-role-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ef Group Role', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'GROUP_ROLE_ID',
            'GROUP_ID',
            'MENU_SUB_ID',
            'ACCESS_FLAG',
            'ADD_FLAG',
            // 'EDIT_FLAG',
            // 'DELETE_FLAG',
            // 'CREATE_BY',
            // 'CREATE_DATE',
            // 'LAST_UPD_BY',
            // 'LAST_UPD_DATE',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
