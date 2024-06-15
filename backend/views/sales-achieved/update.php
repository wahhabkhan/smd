<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SalesAchieved $model */

$this->title = 'Update Sales Achieved: ' . $model->sales_id;
$this->params['breadcrumbs'][] = ['label' => 'Sales Achieved', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sales_id, 'url' => ['view', 'sales_id' => $model->sales_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sales-achieved-update">

    <h3 style="margin-left:180px" class="text-success"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
