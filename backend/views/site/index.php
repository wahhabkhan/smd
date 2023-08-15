<?php $this->beginPage()?>
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
</head>

<body>

    <body>
        <div class="sidebar">

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
                    <a href="<?=Yii::$app->urlManager->createUrl(['intervention/add-intervention'])?>">Add
                        Intervention</a>
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
                    <a href="<?=Yii::$app->urlManager->createUrl(['stakeholder/view-stakeholder'])?>">View
                        Stakeholder</a>
                </div>

                <div class="menu-item" onclick="toggleSubMenu('history')">
                    <a href="">Interventions <br> History</a>
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
            <h2>TextILES Dashboard</h2>
            <p>Objective: TextILES works with various actors from government, NGOs, other donor organizations and
                private sector players. These contacts and trusted relationships have been instrumental for an
                efficient, targeted and successful project implementation...</p>
            <div class="filters">
                <select class="form-select" id="cityFilter" onchange="updateData()">
                    <option selected>Select Organizational Location</option>
                    <option value="sialkot">sialkot</option>
                    <option value="islamabad">islamabad</option>
                    <option value="lahore">lahore</option>

                </select>
                <select class="form-select" id="interventionFilter" onchange="updateData()">
                    <option selected>Select Category</option>
                    <option value="Digital Tools">Digital Tools</option>
                    <option value="garments">garments</option>
                    <option value="cricket ground construction">Cricket Ground Construction</option>
                    <option value="Medicine Distribution">Medicine Distribution</option>

                </select>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="stat-box">
                        <h5>Total Multipliers</h5>
                        <p id="totalMultipliers">0</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-box">
                        <h5>Total Brands</h5>
                        <p id="totalBrands">0</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-box">
                        <h5>Total Factories</h5>
                        <p id="totalFactories">0</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-box">
                        <h5>Associations</h5>
                        <p id="totalassociations">0</p>
                    </div>
                </div>
            </div>

            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <canvas id="stakeholdersChart" width="400" height="400"></canvas>
                    </div>
                    <div class="col-md-6">
                        <canvas id="activitiesChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <h4>GIZ Interventions History</h4>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Year of Intervention</th>
                            <th>GIZ Intervention</th>
                            <th>Focal Person / Contact Person at the time</th>
                            <th>Specifics / Details / Comments</th>
                        </tr>
                    </thead>
                    <tbody id="historyTableBody">

                    </tbody>
                </table>
            </div>

            <div class="table-responsive">
                <h4>GIZ Intervention</h4>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name of Intervention</th>
                            <th>Short description of Intervention</th>
                            <th>GIZ Module</th>
                            <th>Component Manager + Technical Advisors</th>
                            <th>Comments</th>
                        </tr>
                    </thead>
                    <tbody id="interventionTableBody">



                    </tbody>
                </table>
            </div>

        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var stakeholdersCtx = document.getElementById('stakeholdersChart').getContext('2d');
            var stakeholdersChart = new Chart(stakeholdersCtx, {
                type: 'pie',
                data: {
                    labels: ['Government', 'Factories', 'Multipliers', 'Associations',
                        'General Partners', 'Brands', 'Academia'
                    ],
                    datasets: [{
                        label: 'Stakeholders',
                        data: [12, 19, 8, 5, 20, 15, 10],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 206, 86, 0.8)',
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(153, 102, 255, 0.8)',
                            'rgba(255, 159, 64, 0.8)',
                            'rgba(128, 128, 128, 0.8)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(128, 128, 128, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            var activitiesCtx = document.getElementById('activitiesChart').getContext('2d');
            var activitiesChart = new Chart(activitiesCtx, {
                type: 'bar',
                data: {
                    labels: ['Government', 'Factories', 'Multipliers', 'Associations',
                        'General Partners', 'Brands', 'Academia'
                    ],
                    datasets: [{
                        label: 'Activities',
                        data: [9, 15, 7, 8, 12, 14, 4],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 206, 86, 0.8)',
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(153, 102, 255, 0.8)',
                            'rgba(255, 159, 64, 0.8)',
                            'rgba(128, 128, 128, 0.8)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(128, 128, 128, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        });
        </script>

        <script>
        // function updateData() {
        //   let selectedCity = cityFilter.options[cityFilter.selectedIndex].value;
        //   let selectedIntervention = interventionFilter.options[interventionFilter.selectedIndex].value;

        //   fetch(`ajax/ajax_handler.php?city=${selectedCity}&intervention=${selectedIntervention}`)

        //     .then(response => response.json())
        //     .then(data => {
        //       // Update the GIZ Intervention History table
        //       const historyTable = document.getElementById('historyTableBody');
        //       historyTable.innerHTML = ''; // Clear existing rows
        //       data.history.forEach(row => {
        //         const newRow = document.createElement('tr');
        //         newRow.innerHTML = `
        //           <td>${row.year_of_intervention}</td>
        //           <td>${row.giz_intervention}</td>
        //           <td>${row.focal_person}</td>
        //           <td>${row.comments}</td>
        //         `;
        //         historyTable.appendChild(newRow);
        //       });

        //       // Update the GIZ Intervention table
        //       const interventionTable = document.getElementById('interventionTableBody');
        //       interventionTable.innerHTML = ''; // Clear existing rows
        //       data.interventions.forEach(row => {
        //         const newRow = document.createElement('tr');
        //         newRow.innerHTML = `
        //           <td>${row.name_of_intervention}</td>
        //           <td>${row.short_description}</td>
        //           <td>${row.giz_module}</td>
        //           <td>${row.component_manager}</td>
        //           <td>${row.comments}</td>
        //         `;
        //         interventionTable.appendChild(newRow);
        //       });
        //       console.log(selectedCity, selectedIntervention);
        //     })
        //     .catch(error => console.error('Error fetching data:', error));
        // }
        </script>


        <script>
        function updateStats() {
            // Replace the following example values with your actual data
            const totalMultipliers = 100;
            const totalBrands = 200;
            const totalFactories = 300;
            const totalassociations = 50;

            document.getElementById("totalMultipliers").innerText = totalMultipliers;
            document.getElementById("totalBrands").innerText = totalBrands;
            document.getElementById("totalFactories").innerText = totalFactories;
            document.getElementById("totalassociations").innerText = totalassociations;
        }

        // Call the updateStats function when the page loads
        updateStats();
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
</body>

</html>
<?php $this->endPage()?>