<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Contact $model */

$this->title = 'Update Contact: ' . $model->id_contacts;
//$this->params['breadcrumbs'][] = ['label' => 'Contact', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="Contact-update">

    <h4 class="text-danger" style="margin-left: 240px;"><?= Html::encode($this->title) ?></h4>
    <hr>
    <?= $this->render('add-contact', [
        'model' => $model,
    ]) ?>

</div>