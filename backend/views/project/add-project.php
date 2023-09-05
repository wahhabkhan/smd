<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

// Rest of your code

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  

    <div class="content">
        <div class="form-container">
            <div class="project-form">

                <h3 class="text-center text-danger mb-4">Project Form</h3>

                <?php $form = ActiveForm::begin();?>

                <?=$form->field($model, 'name_of_module')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'short_description')->textArea(['maxlength' => true])?>

                <!-- <?=$form->field($model, 'giz_intervention')->textInput(['maxlength' => true])?> -->

                <?= $form->field($model, 'start_date')->widget(DatePicker::classname(), [
    'options' => ['class' => 'form-control'],
    'dateFormat' => 'yyyy-MM-dd', 
]) ?>

<?= $form->field($model, 'end_date')->widget(DatePicker::classname(), [
    'options' => ['class' => 'form-control'],
    'dateFormat' => 'yyyy-MM-dd', 
]) ?>

                <?=$form->field($model, 'av')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'budget')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'comments')->textArea(['maxlength' => true])?>

                <div class="form-group text-center">
                    <?=Html::submitButton('Save', ['class' => 'btn btn-danger w-25 my-4'])?>
                </div>

                <?php ActiveForm::end();?>

            </div>
        </div>
    </div>

</body>

</html>