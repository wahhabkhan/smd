<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Product $model */

$this->title = 'Add Product';
$this->params['breadcrumbs'][] = ['label' => 'Product', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create text-success">

    <h3 style="margin-left:180px"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
