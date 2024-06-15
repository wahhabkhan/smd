<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SalesAchieved $model */

$this->title = 'Add Sales Achieved';
$this->params['breadcrumbs'][] = ['label' => 'Sales Achieved', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-achieved-create text-success">

    <h3 style="margin-left:180px"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
