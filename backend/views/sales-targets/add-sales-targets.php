<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SalesTargets $model */

$this->title = 'Add Sales Target';
$this->params['breadcrumbs'][] = ['label' => 'Sales Targets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-targets-create text-success">

    <h3 style="margin-left:180px"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
