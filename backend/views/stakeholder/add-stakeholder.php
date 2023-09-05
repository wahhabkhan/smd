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
                ?>

                <h3 class="text-center text-danger mb-4">Stakeholder Form</h3>

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'stakeholder_category')->dropDownList($stakeholder, ['prompt' => 'Select Stakeholder Category', 'id' => 'stakeholder-category']) ?>

                <!-- Common fields -->
                <?= $form->field($model, 'organization_name')->textInput(['id' => 'organization_name']) ?>
                <?= $form->field($model, 'legal_form')->textInput(['id' => 'legal_form']) ?>
                <?= $form->field($model, 'stakeholder_cat_specific_info')->textInput(['id' => 'stakeholder_cat_specific_info']) ?>
                <?= $form->field($model, 'organizational_location')->textInput(['id' => 'organizational_location']) ?>
                <?= $form->field($model, 'giz_intervention_history')->textInput(['id' => 'giz_intervention_history']) ?>

                <!-- Container for Government Information -->
                <div id="government-fields" class="category-fields" style="display: none">
                    <?= $form->field($model, 'department')->textInput(['id' => 'department']) ?>
                    <?= $form->field($model, 'sub_category')->textInput(['id' => 'sub_category']) ?>
                </div>

                <!-- Container for Multiplier Information -->
                <div id="multiplier-fields" class="category-fields" style="display: none">
                    <?= $form->field($model, 'size')->textInput(['id' => 'size']) ?>
                    <?= $form->field($model, 'products')->textInput(['id' => 'products']) ?>
                </div>

                <!-- Container for Brands/Buyers Information -->
                <div id="brand-fields" class="category-fields" style="display: none">
                    <?= $form->field($model, 'size')->textInput(['id' => 'size']) ?>
                    <?= $form->field($model, 'products')->textInput(['id' => 'products']) ?>
                    <?= $form->field($model, 'purchasing_capacity')->textInput(['id' => 'purchasing_capacity']) ?>
                    <?= $form->field($model, 'main_purchasing_markets')->textInput(['id' => 'main_purchasing_markets']) ?>
                    <?= $form->field($model, 'main_sales_markets')->textInput(['id' => 'main_sales_markets']) ?>
                    <?= $form->field($model, 'suppling_factories')->textInput(['id' => 'suppling_factories']) ?>
                </div>

                <!-- Container for Factory Information -->
                <div id="factory-fields" class="category-fields" style="display: none">
                    <?= $form->field($model, 'size')->textInput(['id' => 'size']) ?>
                    <?= $form->field($model, 'products')->textInput(['id' => 'products']) ?>
                    <?= $form->field($model, 'production_capacity')->textInput(['id' => 'production_capacity']) ?>
                    <?= $form->field($model, 'main_markets')->textInput(['id' => 'main_markets']) ?>
                    <?= $form->field($model, 'brands')->textInput(['id' => 'brands']) ?>
                </div>

                <!-- Container for Association Information -->
                <div id="association-fields" class="category-fields" style="display: none">
                    <?= $form->field($model, 'objective')->textInput(['id' => 'objective']) ?>
                    <?= $form->field($model, 'main_services')->textInput(['id' => 'main_services']) ?>
                    <?= $form->field($model, 'membership')->textInput(['id' => 'membership']) ?>
                </div>

                <div class="form-group text-center">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-danger w-25 my-4 save-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>

                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const categoryDropdown = document.getElementById('stakeholder-category');
                    const governmentFields = document.getElementById('government-fields');
                    const multiplierFields = document.getElementById('multiplier-fields');
                    const brandFields = document.getElementById('brand-fields');
                    const factoryFields = document.getElementById('factory-fields');
                    const associationFields = document.getElementById('association-fields');

                    function hideAllFields() {
                        governmentFields.style.display = 'none';
                        multiplierFields.style.display = 'none';
                        brandFields.style.display = 'none';
                        factoryFields.style.display = 'none';
                        associationFields.style.display = 'none';
                    }

                    categoryDropdown.addEventListener('change', function() {
                        const selectedCategory = categoryDropdown.value;

                        hideAllFields();

                        if (selectedCategory === 'government') {
                            governmentFields.style.display = 'block';
                        } else if (selectedCategory === 'multiplier') {
                            multiplierFields.style.display = 'block';
                        } else if (selectedCategory === 'brand') {
                            brandFields.style.display = 'block';
                        } else if (selectedCategory === 'factory') {
                            factoryFields.style.display = 'block';
                        } else if (selectedCategory === 'association') {
                            associationFields.style.display = 'block';
                        }
                    });

                    hideAllFields();
                });
                </script>
            </div>
        </div>
    </div>
</body>

</html>