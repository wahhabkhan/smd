<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var array $models */

$this->title = 'Stakeholder View';
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


    <div class="stakeholder-view ms-5">
        <h4 class="text-center text-danger" style="margin-left: 95px"><?= Html::encode($this->title) ?></h4>
        <table style="margin-left: 95px" class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>
                    Stakeholder Category
                    <?= Html::dropDownList('stakeholder_category', null, $stakeholder, ['class' => 'form-control p-1 w-75 text-center mt-2', 'prompt' => 'Select', 'id' => 'stakeholder-category-select']) ?>
                </th>
                <th class="w-25">Organization Name</th>
                <th class="text-center">Action</th>
            </tr>

            <?php foreach ($models as $model) : ?>
            <tr class="stakeholder-row" data-category="<?= $model->stakeholder_category ?>">
                <!-- Table data cells as before -->
                <td><?= $model->stakeholder_id ?></td>
                <td><?= $model->stakeholder_category ?></td>
                <td><?= $model->organization_name ?></td>
                <td>
                    <div class="btn-group" role="group">
                        <?= Html::a('View', ['stakeholder/view-stakeholder-details', 'stakeholder_id' => $model->stakeholder_id], ['class' => 'btn d-flex align-items-center rounded btn-danger ms-1']) ?>
                        <?= Html::a('Update', ['update', 'stakeholder_id' => $model->stakeholder_id], ['class' => 'btn  d-flex align-items-center rounded  btn-danger ms-1']) ?>
                        <?= Html::a('Delete', ['delete', 'stakeholder_id' => $model->stakeholder_id], ['class' => 'btn  d-flex align-items-center rounded  btn-danger ms-1',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        <?= Html::a('Add Contact', ['contact/add-contact', 'stakeholder_id' => $model->stakeholder_id], ['class' => 'btn  rounded btn-primary ms-1']) ?>
                        <?= Html::a('View Contacts', ['contact/view-contact', 'stakeholder_id' => $model->stakeholder_id], ['class' => 'btn  rounded btn-primary ms-1']) ?>
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


    <script>
    document.getElementById('stakeholder-category-select').addEventListener('change', function() {
        const selectedCategory = this.value;
        const rows = document.querySelectorAll('.stakeholder-row');
        rows.forEach(row => {
            if (selectedCategory === 'select' || row.dataset.category === selectedCategory) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    });
    </script>





</body>

</html>