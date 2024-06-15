<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SalesRepresentatives $model */

$this->title = 'Add Sales Representative';
$this->params['breadcrumbs'][] = ['label' => 'Sales Representatives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-representatives-create text-success">

    <h3 style="margin-left:180px"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
