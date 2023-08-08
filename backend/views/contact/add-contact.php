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
    <title>TextILES Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
    padding: 5px 0;
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
    padding: 8px 0; /* Add padding to the top and bottom of the menu items */
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
    padding: 8px 0; /* Add padding to the top and bottom of the sub-menu items */
    margin: 4px 0;
  }
  .nav a {
    color: #000;
    text-decoration: none;
    font-size: 16px; /* Adjust this value to your desired font size */
    padding: 8px 0; /* Add padding to the top and bottom of the menu items */
    margin: 4px 0;
  }

  .nav a:hover {
    color: #1D438A; /* GIZ logo color */
  }

  .menu-item:hover .arrow {
    border-color: #1D438A; /* GIZ logo color */
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
    input, textarea {
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
  <div class="sidebar">
    <div class="giz-logo-container">
      <img src="logo.png" alt="GIZ Logo" width="120">
    </div>

    <nav class="nav flex-column">
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
  <a href="<?=Yii::$app->urlManager->createUrl(['intervention/view-intervention'])?>">View Intervention</a>
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
    </nav>
  </div>

<div class="content">
  <div class="form-container">
  <div class="contact-form">

  <?php
$stakeholders = Stakeholder::find()->all();
$stakeholderList = ArrayHelper::map($stakeholders, 'stakeholder_id', 'stakeholder_category');

        $gender =[
         'Male' => 'Male',
         'Female' => 'Female',
         'Others' => 'Others'
        ];
  ?>

<h3 class="text-center text-danger mb-4">Contact Form</h3>

<?php $form = ActiveForm::begin();?>

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



