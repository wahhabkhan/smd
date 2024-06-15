<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Feedback $model */

$this->title = 'Update Feedback: ' . $model->feedback_id;
$this->params['breadcrumbs'][] = ['label' => 'Feedback', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->feedback_id, 'url' => ['view', 'feedback_id' => $model->feedback_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="feedback-update">

    <h3 style="margin-left:180px" class="text-success"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
