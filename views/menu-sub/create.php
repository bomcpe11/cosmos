<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EfMenuSub */

$this->title = 'สร้างเมนูย่อย';
$this->params['breadcrumbs'][] = ['label' => 'เมนูย่อย', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ef-menu-sub-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
