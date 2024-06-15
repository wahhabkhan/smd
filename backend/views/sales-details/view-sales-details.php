<?php

use yii\helpers\Html;


/** @var yii\web\View $this */
/** @var array $models */

$this->title = 'Sales Details';
//$this->params['breadcrumbs'][] = $this->title;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>


    <div class="ms-5 text-center">
        <h4 class=" text-success" style=""><?=Html::encode($this->title)?></h4>

        <table style="margin-left: 150px" class="table table-bordered w-75">
            <tr>
                <th>Detail ID</th>
                <th>Quantity Sold</th>
                <th>Sales ID - Month Year - Rep ID</th>
                <th>Product</th>
                <th>Action</th>
            </tr>
            <?php foreach ($models as $model): ?>
            <tr>
            <td><?= $model->detail_id ?></td>
    <td><?= $model->quantity_sold ?></td>
    <td><?= $model->sales_id . ' - ' . $salesInfoMap[$model->sales_id]['month_year'] . ' - ' . $salesInfoMap[$model->sales_id]['rep_id'] ?></td>
    <td><?= $model->product->product_name ?></td>

                <td>
                    <div class="btn-group" role="group">
                       
                        <?= Html::a('Update', ['update', 'detail_id' => $model->detail_id], ['class' => 'btn rounded btn-success ms-1']) ?>
                        <?= Html::a('Delete', ['delete', 'detail_id' => $model->detail_id], ['class' => 'btn rounded btn-success ms-1',
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

</body>

</html>