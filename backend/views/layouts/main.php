<?php

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\web\View;

/* @var $this View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
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
    /* ... Paste the provided CSS code here ... */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        width: 200px;
        background-color: light;
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

    body {
        font-family: Arial, sans-serif;
        padding: 20px;
    }
    </style>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header>
        <?php
    NavBar::begin([
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md hover navbar-dark bg-danger fixed-top', // Add justify-content-between class
        ],
    ]);
    ?>

        <!-- Logo section -->
        <div class="navbar-brand">
            <?php
    echo Html::img(Yii::$app->request->baseUrl . '/GIZ_LOGO.png', [
        'alt' => 'GIZ Logo',
        'width' => '60',
        'linkOptions' => ['class' => 'mb-1']
    ]);
    ?>
        </div>


        <?php
    $menuItems = [
        ['label' => 'TextILES', 'url' => ['/site/index'], 'linkOptions' => ['class' => 'ms-2 text-light  mb-1']],
        ['label' => 'Home', 'url' => ['/site/index'], 'linkOptions' => ['class' => 'ms-2 text-light mb-1']],
        // Add more menu items as needed.
    ];

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login mb-1 ms-1'],
    ];
    } else {
        $menuItems[] = [
            'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => [
                'class' => 'logout text-light mb-1 ms-1',
                'data-method' => 'post', // This is the key part for sending a POST request
            ],
        ];
        
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);
    NavBar::end(); // Close the navbar here
    ?>

    </header>

    <main role="main" class="flex-shrink-0">
        <div class="container">
            <?= Alert::widget() ?>
            <div class="sidebar" style="background : #F1e6d8;">

                <nav class="nav flex-column">
                    <br><br>
                    <div class="menu-item" onclick="toggleSubMenu('project')">
                        <a href="#">Project</a>
                        <i class="arrow down"></i>
                    </div>
                    <div class="sub-menu" id="project">
                        <a href="<?=Yii::$app->urlManager->createUrl(['project/add-project'])?>">Add Project</a>
                        <br>
                        <a href="<?=Yii::$app->urlManager->createUrl(['project/view-project'])?>">View Project</a>
                    </div>

                    <div class="menu-item" onclick="toggleSubMenu('intervention')">
                        <a href="#">Intervention</a>
                        <i class="arrow down"></i>
                    </div>
                    <div class="sub-menu" id="intervention">
                        <a href="<?=Yii::$app->urlManager->createUrl(['intervention/add-intervention'])?>">Add
                            Intervention</a>
                        <br>
                        <a href="<?=Yii::$app->urlManager->createUrl(['intervention/view-intervention'])?>">View
                            Intervention</a>
                    </div>

                    <div class="menu-item" onclick="toggleSubMenu('stakeholder')">
                        <a href="#">Stakeholder</a>
                        <i class="arrow down"></i>
                    </div>
                    <div class="sub-menu" id="stakeholder">
                        <a href="<?=Yii::$app->urlManager->createUrl(['stakeholder/add-stakeholder'])?>">Add
                            Stakeholder</a>
                        <br>
                        <a href="<?=Yii::$app->urlManager->createUrl(['stakeholder/view-stakeholder'])?>">View
                            Stakeholder</a>
                    </div>

                    <div class="menu-item" onclick="toggleSubMenu('history')">
                        <a href="#">Interventions <br> History</a>
                        <i class="arrow down"></i>
                    </div>
                    <div class="sub-menu" id="history">
                        <a href="<?=Yii::$app->urlManager->createUrl(['history/add-history'])?>">Add Interventions
                            History</a>
                        <br>
                        <a href="<?=Yii::$app->urlManager->createUrl(['history/view-history'])?>">View Interventions
                            History</a>
                    </div>

                    <div class="menu-item" onclick="toggleSubMenu('user')">
                        <a href="#">Users</a>
                        <i class="arrow down"></i>
                    </div>
                    <div class="sub-menu" id="user">
                        <a href="<?=Yii::$app->urlManager->createUrl(['user/add-user'])?>">Add User</a>
                        <br>
                        <a href="<?=Yii::$app->urlManager->createUrl(['user/view-user'])?>">View User</a>
                    </div>
                </nav>

            </div>
            <?= $content ?>
        </div>
    </main>

    <footer class="footer mt-auto py-3 text-muted">
        <div class="container">

        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage(); ?>
<script>
function toggleSubMenu(id) {
    const subMenu = document.getElementById(id);
    const arrow = subMenu.previousElementSibling.querySelector('.arrow');
    subMenu.style.display = subMenu.style.display === "block" ? "none" : "block";
    arrow.classList.toggle('down');
    arrow.classList.toggle('up');
}
</script>