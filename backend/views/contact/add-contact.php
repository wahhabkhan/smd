<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Stakeholder;
use yii\helpers\ArrayHelper;

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
            <div class="contact-form">

<?php
$stakeholders = Stakeholder::find()->all();
$stakeholderList = ArrayHelper::map($stakeholders, 'stakeholder_id', 'organization_name');

        $gender =[
         'Male' => 'Male',
         'Female' => 'Female',
         'Others' => 'Others'
        ];
  ?>

                <h3 class="text-center text-danger mb-4">Contact Form</h3>

                <?php $form = ActiveForm::begin(); ?>


                <?= $form->field($model, 'stakeholder_id')->dropDownList(
            $stakeholderList,
            ['prompt' => 'Select Stakeholder']
        ) ?>

                <?=$form->field($model, 'contact_category')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'gender')->dropDownList(
    $gender,
    ['prompt' => 'Select Gender']
)?>


                <?=$form->field($model, 'academic_titles')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'last_name')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'first_name')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'call_name')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'current_company')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'designation')->textarea(['rows' => true])?>

                <?=$form->field($model, 'previous_company')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'house_number')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'street')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'city')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'postal_code')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'extra_info_of_place')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'country')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'web_link')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'geo_data')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'landline_phone_1')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'landline_phone_2')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'fax')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'cell_phone_1')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'cell_phone_2')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'cell_phone_3')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'cell_phone_4')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'email_1')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'email_2')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'email_3')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'email_4')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'whatsapp_1')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'whatsapp_2')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'whatsapp_3')->textInput(['maxlength' => true])?>

                <?=$form->field($model, 'whatsapp_4')->textInput(['maxlength' => true])?>

                <div class="form-group text-center">
                    <?=Html::submitButton('Save', ['class' => 'btn btn-danger w-25 my-4'])?>
                </div>

                <?php ActiveForm::end();?>

            </div>
        </div>
    </div>


</body>

</html>