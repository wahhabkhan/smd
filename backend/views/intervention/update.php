<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Intervention $model */

$this->title = 'Update Intervention: ' . $model->intervention_id;
//$this->params['breadcrumbs'][] = ['label' => 'Intervention', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="Intervention-update">

    <h4 class="text-danger" style="margin-left: 240px;"><?= Html::encode($this->title) ?></h4>
    
    <?= $this->render('add-intervention', [
        'model' => $model,
    ]) ?>

</div>
