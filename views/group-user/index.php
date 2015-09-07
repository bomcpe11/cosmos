<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\grid\EditableColumn ;
use kartik\datecontrol\DateControl;
use kartik\grid\DataColumn;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EfGroupUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Group Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ef-group-user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ef Group User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'GROUP_USER_ID',
            'GROUP_ID',
            'USER_ID',
            'CREATE_BY',
            'CREATE_DATE',
            // 'LAST_UPD_BY',
            // 'LAST_UPD_DATE',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
