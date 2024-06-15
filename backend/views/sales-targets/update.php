<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SalesTargets $model */

$this->title = 'Update Sales Targets: ' . $model->target_id;
$this->params['breadcrumbs'][] = ['label' => 'Sales Targets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->target_id, 'url' => ['view', 'target_id' => $model->target_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sales-targets-update">

    <h3 style="margin-left:180px" class="text-success"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
