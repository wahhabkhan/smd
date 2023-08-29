<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Stakeholder $model */

$this->title = 'Update Stakeholder: ' . $model->stakeholder_id;
//$this->params['breadcrumbs'][] = ['label' => 'Stakeholder', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="Stakeholder-update">

 <h4 class="text-danger" style="margin-left: 240px;"><?= Html::encode($this->title) ?></h4>
    
    <?= $this->render('add-stakeholder', [
        'model' => $model,
    ]) ?>

</div>