<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Intervention $model */

$this->title = 'Update Project: ' . $model->project_id;
//$this->params['breadcrumbs'][] = ['label' => 'project', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="Project-update">

    <h4 class="text-danger" style="margin-left: 240px;"><?= Html::encode($this->title) ?></h4>
    <hr>
    <?= $this->render('add-project', [
        'model' => $model,
    ]) ?>

</div>
