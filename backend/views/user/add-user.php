<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
            <div class="user-form">

                <h3 class="text-center text-danger mb-4">User Form</h3>

                <?php $form = ActiveForm::begin();?>

                <?=$form->field($model, 'name')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'email')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'username')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'password_hash')->passwordInput(['maxlength' => true])?>

                <div class="form-group text-center">
                    <?=Html::submitButton('Save', ['class' => 'btn btn-danger w-25 my-4'])?>
                </div>

                <?php ActiveForm::end();?>

            </div>
        </div>
    </div>


</body>

</html>