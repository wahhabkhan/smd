<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Users;

/** @var yii\web\View $this */
/** @var common\models\Product $model */
/** @var yii\widgets\ActiveForm $form */

?>


<div style="margin-left: 180px" class="product-form w-75">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
