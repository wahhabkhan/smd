<?php 
use yii\grid\GridView;
?>

        <div class="content">
            <h2>TextILES Dashboard</h2>
            <p>Objective: TextILES works with various actors from government, NGOs, other donor organizations and
                private sector players. These contacts and trusted relationships have been instrumental for an
                efficient, targeted and successful project implementation...</p>
            <div class="filters">
                <form class='d-flex'>
                    <select name="location" class="form-select w-100" id="cityFilter" onchange="updateData()">
                        <option value='' selected>Select Location</option>

                        <?php foreach($locationData as $location){ ?>
                        <option value="<?= $location['organizational_location'] ?>">
                            <?= $location['organizational_location'] ?></option>
                        <?php } ?>

                    </select>
                    <select name="category" class="form-select ms-2 w-100" id="interventionFilter"
                        onchange="updateData()">
                        <option value='' selected>Select Category</option>

                        <?php foreach($categoryData as $category){ ?>
                        <option value="<?= $category['giz_intervention'] ?>"><?= $category['giz_intervention'] ?>
                        </option>
                        <?php } ?>

                    </select>
                    <button class="ms-2 btn-danger rounded">Filter</button>
                </form>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="w-75 stat-box">
                        <h5>Total Multipliers</h5>
                        <p id="totalMultipliers">
                        <?= $categoryCounts['multiplier'] ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="w-75 stat-box">
                        <h5>Total<br> Brands</h5>
                        <p id="totalBrands">
                        <?= $categoryCounts['brand'] ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="w-75 stat-box">
                        <h5>Total Factories</h5>
                        <p id="totalFactories">
                        <?= $categoryCounts['factory'] ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="w-75 stat-box">
                        <h5>Total Associations</h5>
                        <p id="totalassociations">
                        <?= $categoryCounts['association'] ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="w-75 stat-box">
                        <h5>Government</h5>
                        <p id="totalGovernment">
                        <?= $categoryCounts['government'] ?>
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
                <?php
                 
                    echo GridView::widget([
                     
                        'dataProvider' => new \yii\data\ArrayDataProvider([
                            'allModels' => $activitiesGridData,
                            'pagination' => [
                                'pageSize' => 10, // Adjust as needed
                            ],
                        ]),
                        'columns' => [
                            'year_of_intervention',
                            'giz_intervention',
                            'focal_person',
                            'comments',
                          
                          ],
                    ]);
               ?>
            </div>

            <div class="table-responsive">
                <h4>GIZ Intervention</h4>
              
              <?php
            //    echo '<pre>';
            //    print_r($activitiesGridData2); // Print the fetched data
            //    echo '</pre>';   
              ?>

                <?php
                    echo GridView::widget([
                        'dataProvider' => new \yii\data\ArrayDataProvider([
                            'allModels' => $activitiesGridData2,
                            'pagination' => [
                                'pageSize' => 10, 
                            ],
                        ]),
                        'columns' => [
                            'name_of_intervention' ,
                            'short_description' ,
                          //  'giz_module' ,
                            'component_manager' ,
                            'comments',
                             
                        ],
                    ]);
               ?>
            </div>

        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var stakeholdersCtx = document.getElementById('stakeholdersChart').getContext('2d');
            var stakeholdersChart = new Chart(stakeholdersCtx, {
                type: 'pie',
                data: {
                    labels: <?= json_encode($stakeholderChartLabels) ?>,
                    datasets: [{
                        label: 'Stakeholders',
                        data: <?= json_encode($stakeholderChartData)?>,
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
                    labels: <?= json_encode($stakeholderChartLabels)?>,
                    datasets: [{
                        label: '',
                        data: <?= json_encode($stakeholderChartData)?>,
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
        function updateData() {
            let selectedCity = cityFilter.options[cityFilter.selectedIndex].value;
            let selectedIntervention = interventionFilter.options[interventionFilter.selectedIndex].value;
            //implement logic
        }
        </script>


 

