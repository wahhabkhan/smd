<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\History $model */

$this->title = 'Update Interventions History: ' . $model->intervention_history_id;
//$this->params['breadcrumbs'][] = ['label' => 'history', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="History-update">

    <h4 class="text-danger" style="margin-left: 240px;"><?= Html::encode($this->title) ?></h4>
    <hr>
    <?= $this->render('add-history', [
        'model' => $model,
    ]) ?>

</div>