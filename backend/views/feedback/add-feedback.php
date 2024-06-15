<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Feedback $model */

$this->title = 'Add Feedback';
$this->params['breadcrumbs'][] = ['label' => 'Feedback', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-create text-success">

    <h3 style="margin-left:180px"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
