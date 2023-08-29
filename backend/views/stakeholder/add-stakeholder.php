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
            <div class="government-form">

                <?php
$stakeholder = [
    'government' => 'Government',
    'multiplier' => 'Multiplier',
    'factory' => 'Factory',
    'association' => 'Association',
    'brand' => 'Brand',
];

$organizations = [
    'Ministry of Health' => 'Ministry of Health',
    'Ministry of Education' => 'Ministry of Education',
    'Ministry of Finance' => 'Ministry of Finance',
    'Local Government' => 'Local Government',
];

$sizes = [
    'Small' => 'Small',
    'Medium' => 'Medium',
    'Large' => 'Large',
];

$products = [
    'Shoes' => 'Shoes',
    'Clothes' => 'Clothes',
    'Accessories' => 'Accessories',
    'Sports Equipment' => 'Sports Equipment',
    'Home Goods' => 'Home Goods',
];
?>

                <h3 class="text-center text-danger mb-4">Stakeholder Form</h3>

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'stakeholder_category')->dropDownList($stakeholder, ['prompt' => 'Select Stakeholder Category', 'id' => 'stakeholder-category']) ?>

                <!-- Government category fields -->
                <div data-stakeholder="government">
                    <?= $form->field($model, 'organization_name')->textInput() ?>
                    <?= $form->field($model, 'legal_form')->textInput() ?>
                    <?= $form->field($model, 'stakeholder_cat_specific_info')->textInput() ?>
                    <?= $form->field($model, 'department')->textInput() ?>
                    <?= $form->field($model, 'sub_category')->textInput() ?>
                    <?= $form->field($model, 'organizational_location')->textInput() ?>
                    <?= $form->field($model, 'giz_intervention_history')->textInput() ?>
                    <div class="form-group text-center">
                        <?=Html::submitButton('Save', ['class' => 'btn btn-danger w-25 my-4'])?>
                    </div>
                </div>

                <!-- Multiplier category fields -->
                <div data-stakeholder="multiplier">
                    <?= $form->field($model, 'organization_name')->textInput() ?>
                    <?= $form->field($model, 'legal_form')->textInput() ?>
                    <?= $form->field($model, 'stakeholder_cat_specific_info')->textInput() ?>
                    <?= $form->field($model, 'size')->textInput() ?>
                    <?= $form->field($model, 'products')->textInput() ?>
                    <?= $form->field($model, 'giz_intervention_history')->textInput() ?>
                </div>

                <!-- Factory category fields -->
                <div data-stakeholder="factory">
                    <?= $form->field($model, 'organization_name')->textInput() ?>
                    <?= $form->field($model, 'legal_form')->textInput() ?>
                    <?= $form->field($model, 'stakeholder_cat_specific_info')->textInput() ?>
                    <?= $form->field($model, 'size')->textInput() ?>
                    <?= $form->field($model, 'products')->textInput() ?>
                    <?= $form->field($model, 'production_capacity')->textInput() ?>
                    <?= $form->field($model, 'main_markets')->textInput() ?>
                    <?= $form->field($model, 'brands')->textInput() ?>
                    <?= $form->field($model, 'giz_intervention_history')->textInput() ?>
                </div>

                <!-- Association category fields -->
                <div data-stakeholder="association">
                    <?= $form->field($model, 'organization_name')->textInput() ?>
                    <?= $form->field($model, 'legal_form')->textInput() ?>
                    <?= $form->field($model, 'stakeholder_cat_specific_info')->textInput() ?>
                    <?= $form->field($model, 'objective')->textInput() ?>
                    <?= $form->field($model, 'main_services')->textInput() ?>
                    <?= $form->field($model, 'membership')->textInput() ?>
                    <?= $form->field($model, 'giz_intervention_history')->textInput() ?>
                </div>

                <!-- Brand category fields -->
                <div data-stakeholder="brand">
                    <?= $form->field($model, 'organization_name')->textInput() ?>
                    <?= $form->field($model, 'legal_form')->textInput() ?>
                    <?= $form->field($model, 'stakeholder_cat_specific_info')->textInput() ?>
                    <?= $form->field($model, 'size')->textInput() ?>
                    <?= $form->field($model, 'products')->textInput() ?>
                    <?= $form->field($model, 'purchasing_capacity')->textInput() ?>
                    <?= $form->field($model, 'main_purchasing_markets')->textInput() ?>
                    <?= $form->field($model, 'main_sales_markets')->textInput() ?>
                    <?= $form->field($model, 'suppling_factories')->textInput() ?>
                    <?= $form->field($model, 'giz_intervention_history')->textInput() ?>
                </div>

                <!-- Add more fields for other stakeholder categories in a similar way -->

                <?php ActiveForm::end(); ?>


            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryDropdown = document.getElementById('stakeholder-category');
        const governmentFields = document.querySelector('[data-stakeholder="government"]');
        const multiplierFields = document.querySelector('[data-stakeholder="multiplier"]');
        const factoryFields = document.querySelector('[data-stakeholder="factory"]');
        const associationFields = document.querySelector('[data-stakeholder="association"]');
        const brandFields = document.querySelector('[data-stakeholder="brand"]');

        function hideAllFields() {
            governmentFields.style.display = 'none';
            multiplierFields.style.display = 'none';
            factoryFields.style.display = 'none';
            associationFields.style.display = 'none';
            brandFields.style.display = 'none';
        }

        categoryDropdown.addEventListener('change', function() {
            const selectedCategory = categoryDropdown.value;

            hideAllFields();

            if (selectedCategory === 'government') {
                governmentFields.style.display = 'block';
            } else if (selectedCategory === 'multiplier') {
                multiplierFields.style.display = 'block';
            } else if (selectedCategory === 'factory') {
                factoryFields.style.display = 'block';
            } else if (selectedCategory === 'association') {
                associationFields.style.display = 'block';
            } else if (selectedCategory === 'brand') {
                brandFields.style.display = 'block';
            }
        });

        hideAllFields(); // Hide all fields initially
    });
    </script>


</body>

</html>