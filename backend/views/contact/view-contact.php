<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/** @var yii\web\View $this */
/** @var array $models */

$this->title = 'Contact View';
$this->params['breadcrumbs'][] = ['label' => 'Stakeholder View', 'url' => ['stakeholder/view-stakeholder'],
              'class' => 'text-danger'];

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


    <div class="contact-view ms-5">
        <h4 class="text-center text-danger" style="margin-left: 95px"><?= Html::encode($this->title) ?></h4>
        <div class=''>
            <?= Breadcrumbs::widget([
        'links' => $this->params['breadcrumbs'],
        'itemTemplate' => '<li class="breadcrumb-item">{link}</li>',
        'homeLink' => [
          'label' => 'Home',
          'url' => Yii::$app->homeUrl,
          'class' => 'text-danger',
          'style' => 'margin-left: 100px;' 
      ],
    ]) ?>
        </div>
        <table style="margin-left:95px" class="table table-bordered ">
            <tr>
                <th>ID</th>
                <th>Stakeholder</th>
                <th>First Name</th>
                <th>Current Company</th>
                <th>Designation</th>
                <th>Cell Phone 1</th>



                <th>Action</th>
            </tr>
            <?php foreach ($models as $model): ?>
            <tr>
                <td><?=$model->id_contacts?></td>
                <td><?= $model->stakeholder->stakeholder_category ?></td>
                <td><?=$model->first_name?></td>
                <td><?=$model->current_company?></td>
                <td><?=$model->designation?></td>
                <td><?=$model->cell_phone_1?></td>

                <td>
                    <div class="btn-group" role="group">
                        <?= Html::a('View', ['contact/view-contact-details', 'id_contacts' => $model->id_contacts], ['class' => 'btn rounded btn-danger ms-1']) ?>
                        <?= Html::a('Update', ['update', 'id_contacts' => $model->id_contacts], ['class' => 'btn rounded btn-danger ms-1']) ?>
                        <?= Html::a('Delete', ['delete', 'id_contacts' => $model->id_contacts], ['class' => 'btn rounded btn-danger ms-1',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]) ?>

                    </div>
                </td>
            </tr>

            <?php endforeach; ?>
        </table>
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