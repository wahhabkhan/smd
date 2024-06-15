<?php

use yii\helpers\Html;


/** @var yii\web\View $this */
/** @var array $models */

$this->title = 'Product';
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
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            <?php foreach ($models as $model): ?>
            <tr>
                <td><?= $model->product_id ?></td>
                <td><?= $model->product_name ?></td>
                <td><?= $model->price?></td>
                <td>
                    <div class="btn-group" role="group">
                       
                        <?= Html::a('Update', ['update', 'product_id' => $model->product_id], ['class' => 'btn rounded btn-success ms-1']) ?>
                        <?= Html::a('Delete', ['delete', 'product_id' => $model->product_id], ['class' => 'btn rounded btn-success ms-1',
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
        <?= \yii\widgets\LinkPager::widget([
    'pagination' => $dataProvider->pagination,
]) ?>



    </div>

</body>

</html>