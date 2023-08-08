<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Government $model */

$this->title = 'Update Government: ' . $model->stakeholder_id;
//$this->params['breadcrumbs'][] = ['label' => 'Government', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="Government-update">

    <h4 class="text-danger" style="margin-left: 240px;"><?= Html::encode($this->title) ?></h4>
    <hr>
    <?= $this->render('add-government', [
        'model' => $model,
    ]) ?>

</div>
