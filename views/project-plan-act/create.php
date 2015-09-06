<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EfProjectPlanAct */

$this->title = Yii::t('app', 'Create Ef Project Plan Act');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ef Project Plan Acts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ef-project-plan-act-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
