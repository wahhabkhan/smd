<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\SalesRepresentatives;

/** @var yii\web\View $this */
/** @var common\models\Feedback $model */
/** @var yii\widgets\ActiveForm $form */

// Assuming you have a SalesRepresentatives model with a relation to Users named 'user'
$repList = SalesRepresentatives::find()
    ->select(['rep_id', 'users.name AS user_name']) // Include the user name
    ->leftJoin('users', 'users.id = sales_representatives.id') // Assuming the foreign key relationship is 'id'
    ->asArray()
    ->all();

$repList = ArrayHelper::map($repList, 'rep_id', 'user_name'); // Map rep_id to user_name

?>


<div style="margin-left: 180px" class="feedback-form w-75">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rep_id')->dropDownList(
    $repList,
    ['prompt' => 'Select Representatives']
    )->label('Sales Representative Name') ?>

   <?= $form->field($model, 'feedback_text')->textArea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>