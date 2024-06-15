<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = 'Update User: ' . $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'user', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="User-update">

    <h4 class="text-success" style="margin-left: 240px;"><?= Html::encode($this->title) ?></h4>
    <?= $this->render('add-user', [
        'model' => $model,
    ]) ?>

</div>
