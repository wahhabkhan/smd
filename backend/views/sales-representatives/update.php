<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SalesRepresentatives $model */

$this->title = 'Update Sales Representative: ' . $model->rep_id;
$this->params['breadcrumbs'][] = ['label' => 'Sales Representatives', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->rep_id, 'url' => ['view', 'rep_id' => $model->rep_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sales-representatives-update">

    <h3 style="margin-left:180px" class="text-success"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
