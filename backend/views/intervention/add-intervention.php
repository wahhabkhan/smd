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
            <div class="intervention-form">

                <?php
$intervention = [
    'Digital Tools' => 'Digital Tools',
    'Garments' => 'Garments',
    'Education' => 'Education',
];
$project = [
   'Training' => 'Training',
];
?>

                <h3 class="text-center text-danger mb-4">Intervention Form</h3>

                <?php $form = ActiveForm::begin();?>

                <?=$form->field($model, 'name_of_intervention')->dropDownList(
    $intervention,
    ['prompt' => 'Select Intervention']
)?>

                <?=$form->field($model, 'short_description')->textArea(['maxlength' => true])?>

                <!-- <?=$form->field($model, 'giz_module')->dropDownList(
    $project,
    ['prompt' => 'Select GIZ Project']
)?> -->

                <?=$form->field($model, 'component_manager')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'comments')->textArea(['maxlength' => true])?>

                <div class="form-group text-center">
                    <?=Html::submitButton('Save', ['class' => 'btn btn-danger my-4 w-25'])?>
                </div>

                <?php ActiveForm::end();?>

            </div>
        </div>
    </div>

</body>

</html>