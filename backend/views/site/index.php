<?php 
use yii\grid\GridView;
?>

<div class="content">
    <h3 class="text-success mb-4">Sales Management Dashboard</h3>
    <div class="filters">
        <form class='d-flex'>
            <select name="monthyear" class="form-select w-100" id="monthyearFilter" onchange="updateData()">
                <option value='' selected>Select Month-Year</option>

                <?php foreach ($monthyearData as $monthyearValue) { ?>
                    <option value="<?= $monthyearValue ?>"><?= $monthyearValue ?></option>
                <?php } ?>
            </select>

            <select name="salesrepresentative" class="form-select ms-2 w-100" id="salesrepresentativeFilter"
                onchange="updateData()">
                <option class="" value='' selected>Select Representative</option>

                <?php foreach ($salesrepresentativesData as $repId => $repName) { ?>
                    <option value="<?= $repId ?>"><?= $repName ?></option>
                <?php } ?>

            </select>
            <button class="ms-2 btn-success rounded">Filter</button>
        </form>
    </div>


    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <canvas id="salesChart" width="400" height="400"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="productChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>

    <div>
        <div>
            <canvas id="salesachievedChart" width="400" height="400"></canvas>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var salesCtx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(salesCtx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [
                {
                    label: 'Sales Achieved',
                    data: [],
                    backgroundColor: 'rgba(54, 162, 235, 0.8)',
                },
                {
                    label: 'Sales Target',
                    data: [],
                    backgroundColor: 'rgba(255, 99, 132, 0.8)',
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
            },
        },
    });

    var monthYearFilter = document.getElementById('monthyearFilter'); // Corrected ID
   
    var filterButton = document.querySelector('.btn-success'); // Using class to select the button

    filterButton.addEventListener('click', function () {
        var selectedMonthYear = monthYearFilter.value;

        if (selectedMonthYear) {
            // Make an AJAX request to retrieve sales data for the selected monthYear and representative
            $.ajax({
                url: 'index.php?r=site/get-sales-data',
                method: 'GET',
                data: {
                    monthYear: selectedMonthYear,
                },
                success: function (response) {
                    // Update the salesChart with new data
                    salesChart.data.labels = response.labels;
                    salesChart.data.datasets[0].data = response.salesAchieved;
                    salesChart.data.datasets[1].data = response.salesTargets;
                    salesChart.update();
                },
                error: function () {
                    console.error('Error fetching data.');
                },
            });
        }
    });
});

var productCategories = ["Category A", "Category B", "Category C"];
  var salesQuantities = [50, 30, 20];

var productCtx = document.getElementById('productChart').getContext('2d');
    var productChart = new Chart(productCtx, {
        type: 'pie',
        data: {
            labels: productCategories, // Product names will be dynamically populated
            datasets: [{
                label: 'Sales Distribution based on Products',
                data: salesQuantities, // Sales quantities for each product will be dynamically populated
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

    // Add an event listener to update the pie chart when the filter is applied
    var filterButton = document.querySelector('.btn-success');
    filterButton.addEventListener('click', function () {
        var selectedMonthYear = monthYearFilter.value;

        if (selectedMonthYear) {
            // Make an AJAX request to retrieve sales data for the selected monthYear
            $.ajax({
                url: 'index.php?r=site/get-product-data', // Define the URL for fetching product data
                method: 'GET',
                data: {
                    monthYear: selectedMonthYear,
                },
                success: function (response) {
                    // Update the productChart with new data
                    productChart.data.labels = response.productNames;
                    productChart.data.datasets[0].data = response.salesQuantities;
                    productChart.update();
                },
                error: function () {
                    console.error('Error fetching data.');
                },
            });
        }
    });



//     var salesachievedCtx = document.getElementById('salesachievedChart').getContext('2d');
//     var salesachievedChart = new Chart(salesachievedCtx, {
//         type: 'line',
//         data: {
//             labels: 
//             datasets: [{
//                 label: 'Sales Achieved',
//                 data: 
//                 backgroundColor: [
//                     'rgba(255, 99, 132, 0.8)',
//                     'rgba(54, 162, 235, 0.8)',
//                     'rgba(255, 206, 86, 0.8)',
//                     'rgba(75, 192, 192, 0.8)',
//                     'rgba(153, 102, 255, 0.8)',
//                     'rgba(255, 159, 64, 0.8)',
//                     'rgba(128, 128, 128, 0.8)'
//                 ],
//                 borderColor: [
//                     'rgba(255, 99, 132, 1)',
//                     'rgba(54, 162, 235, 1)',
//                     'rgba(255, 206, 86, 1)',
//                     'rgba(75, 192, 192, 1)',
//                     'rgba(153, 102, 255, 1)',
//                     'rgba(255, 159, 64, 1)',
//                     'rgba(128, 128, 128, 1)'
//                 ],
//                 borderWidth: 1
//             }]
//         },
//         options: {
//             responsive: true,
//             plugins: {
//                 legend: {
//                     position: 'bottom'
//                 }
//             }
//         }
//     });
// });
 </script>

 <script>
function updateData() {
    let selectedMonthYear = monthyearFilter.options[monthyearFilter.selectedIndex].value;
    let selectedSalesRepresentative = document.getElementById('salesrepresentativeFilter').value;


    
}

</script>