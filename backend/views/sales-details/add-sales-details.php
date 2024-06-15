<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SalesDetails $model */

$this->title = 'Add Sales Details';
$this->params['breadcrumbs'][] = ['label' => 'Sales Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-detail-create text-success">

    <h3 style="margin-left:180px"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
