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
    <title>TextILES Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        width: 200px;
        background-color: #f8f9fa;
        padding: 20px;
        overflow-y: auto;
    }

    .giz-logo-container {
        margin-bottom: 20px;
    }

    .nav {
        flex-direction: column;
    }

    .nav-link {
        padding: 8px 0;
    }

    .content {
        margin-left: 220px;
        padding: 20px;
    }

    .filters {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .stat-box {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        padding: 20px;
        border-radius: 5px;
        text-align: center;
        margin-bottom: 20px;
    }

    .stat-box h5 {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .table-responsive {
        margin-bottom: 40px;
    }

    h4 {
        margin-bottom: 20px;
    }

    .menu-item {
        position: relative;
        cursor: pointer;
        padding: 8px 0;
        /* Add padding to the top and bottom of the menu items */
        margin: 4px 0;
    }

    .arrow {
        border: solid #333;
        border-width: 0 2px 2px 0;
        display: inline-block;
        padding: 3px;
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
    }

    .arrow.down {
        transform: translateY(-50%) rotate(45deg);
    }

    .arrow.up {
        transform: translateY(-50%) rotate(-135deg);
    }

    .sub-menu {
        display: none;
        padding-left: 20px;
        padding: 8px 0;
        /* Add padding to the top and bottom of the sub-menu items */
        margin: 4px 0;
    }

    .nav a {
        color: #000;
        text-decoration: none;
        font-size: 16px;
        /* Adjust this value to your desired font size */
        padding: 8px 0;
        /* Add padding to the top and bottom of the menu items */
        margin: 4px 0;
    }

    .nav a:hover {
        color: red;
        /* GIZ logo color */
    }

    .menu-item:hover .arrow {
        border-color: red;
        /* GIZ logo color */
    }

    h2 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-size: 16px;
        margin-bottom: 5px;
    }

    input,
    textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 3px;
        font-size: 16px;
        outline: none;
    }

    button {
        background-color: #1D438A;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 3px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 10px;
        width: 100%;
    }

    button:hover {
        background-color: #0f2a6e;
    }

    body {
        font-family: Arial, sans-serif;
        padding: 20px;
    }
    </style>
</head>

<body>
    <div class="sidebar" style="background : #F1e6d8;">

        <nav class="nav flex-column">
            <br><br>
            <div class="menu-item" onclick="toggleSubMenu('project')">
                <a href="">Project</a>
                <i class="arrow down"></i>
            </div>
            <div class="sub-menu" id="project">
                <a href="<?=Yii::$app->urlManager->createUrl(['project/add-project'])?>">Add Project</a>
                <br>
                <a href="<?=Yii::$app->urlManager->createUrl(['project/view-project'])?>">View Project</a>
            </div>

            <div class="menu-item" onclick="toggleSubMenu('intervention')">
                <a href="">Intervention</a>
                <i class="arrow down"></i>
            </div>
            <div class="sub-menu" id="intervention">
                <a href="<?=Yii::$app->urlManager->createUrl(['intervention/add-intervention'])?>">Add Intervention</a>
                <br>
                <a href="<?=Yii::$app->urlManager->createUrl(['intervention/view-intervention'])?>">View
                    Intervention</a>
            </div>

            <div class="menu-item" onclick="toggleSubMenu('stakeholder')">
                <a href="">Stakeholder</a>
                <i class="arrow down"></i>
            </div>
            <div class="sub-menu" id="stakeholder">
                <a href="<?=Yii::$app->urlManager->createUrl(['stakeholder/add-stakeholder'])?>">Add Stakeholder</a>
                <br>
                <a href="<?=Yii::$app->urlManager->createUrl(['stakeholder/view-stakeholder'])?>">View Stakeholder</a>
            </div>

            <div class="menu-item" onclick="toggleSubMenu('history')">
                <a href="">Interventions <br> History</a>
                <i class="arrow down"></i>
            </div>
            <div class="sub-menu" id="history">
                <a href="<?=Yii::$app->urlManager->createUrl(['history/add-history'])?>">Add Interventions History</a>
                <br>
                <a href="<?=Yii::$app->urlManager->createUrl(['history/view-history'])?>">View Interventions History</a>
            </div>

            <div class="menu-item" onclick="toggleSubMenu('user')">
                <a href="">Users</a>
                <i class="arrow down"></i>
            </div>
            <div class="sub-menu" id="user">
                <a href="<?=Yii::$app->urlManager->createUrl(['user/add-user'])?>">Add User</a>
                <br>
                <a href="<?=Yii::$app->urlManager->createUrl(['user/view-user'])?>">View User</a>
            </div>
        </nav>
    </div>

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


    <script>
    function toggleSubMenu(id) {
        const subMenu = document.getElementById(id);
        const arrow = subMenu.previousElementSibling.querySelector('.arrow');
        subMenu.style.display = subMenu.style.display === "block" ? "none" : "block";
        arrow.classList.toggle('down');
        arrow.classList.toggle('up');
    }
    </script>

</body>

</html>