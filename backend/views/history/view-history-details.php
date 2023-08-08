<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\History */

$this->title = 'View History Details';
//$this->params['breadcrumbs'][] = ['label' => 'History', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
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
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
    }
    .table-actions {

      display: flex;
      justify-content: space-around;
    }

    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-3">   
  <div class="sidebar">
    <div class="giz-logo-container">
      <img src="logo.png" alt="GIZ Logo" width="120">
    </div>

    <nav class="nav flex-column">
    <div class="menu-item" onclick="toggleSubMenu('intervention')">
        <a href="">Intervention</a>
        <i class="arrow down"></i>
      </div>
      <div class="sub-menu" id="intervention">
  <a href="<?=Yii::$app->urlManager->createUrl(['intervention/add-intervention'])?>">Add Intervention</a>
  <br>
  <a href="<?=Yii::$app->urlManager->createUrl(['intervention/view-intervention'])?>">View Intervention</a>
</div>
<div class="menu-item" onclick="toggleSubMenu('project')">
        <a href="">Project</a>
        <i class="arrow down"></i>
      </div>
      <div class="sub-menu" id="project">
  <a href="<?=Yii::$app->urlManager->createUrl(['project/add-project'])?>">Add Project</a>
  <br>
  <a href="<?=Yii::$app->urlManager->createUrl(['project/view-project'])?>">View  Project</a>
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
  </div>
  <div class="col-md-9">
<div class="history-view">

    <h3 class="text-center text-danger my-3"><?= $this->title ?></h3>
    <div class="row">
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'intervention_history_id' ,
            'year_of_intervention' ,
            'giz_intervention' ,
            'focal_person' ,
            'comments' ,
            [
                'attribute' => 'stakeholder_id',
                'value' => $model->stakeholder->stakeholder_category,
            ],
            [
                'attribute' => 'project_id',
                'value' => $model->project->name_of_module,
            ],
            [
                'attribute' => 'intervention_id',
                'value' => $model->intervention->name_of_intervention,
            ], 
        ],
    ]) ?>
</div>
</div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
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
