<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SalesDetails $model */

$this->title = 'Update Sales Details: ' . $model->detail_id;
$this->params['breadcrumbs'][] = ['label' => 'Sales Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->detail_id, 'url' => ['view', 'detail_id' => $model->detail_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sales-Details-update">

    <h3 style="margin-left:180px" class="text-success"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
