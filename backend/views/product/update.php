<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Product $model */

$this->title = 'Update product: ' . $model->product_id;
$this->params['breadcrumbs'][] = ['label' => 'product', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product_id, 'url' => ['view', 'product_id' => $model->product_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-update">

    <h3 style="margin-left:180px" class="text-success"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
