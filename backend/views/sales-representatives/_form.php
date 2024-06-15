<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Users;

/** @var yii\web\View $this */
/** @var common\models\SalesRepresentatives $model */
/** @var yii\widgets\ActiveForm $form */

$users = Users::find()->all();
$userList = ArrayHelper::map($users, 'id', 'name');
?>


<div style="margin-left: 180px" class="sales-representatives-form w-75">

    <?php $form = ActiveForm::begin(); ?>

    

    <?= $form->field($model, 'contact_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'region')->textInput(['maxlength' => true]) ?>

               <?=$form->field($model, 'id')->dropDownList(
                $userList,
                ['prompt' => 'Select User']
                )?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
