<?php

use yii\helpers\Html;


/** @var yii\web\View $this */
/** @var array $models */

$this->title = 'Sales Targets';
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
                <th>Target ID</th>
                <th>Month Year</th>
                <th>Sales Target Amount</th>
                <th>Rep Name</th>
                <th>Action</th>
            </tr>
            <?php foreach ($models as $model): ?>
            <tr>
                <td><?= $model->target_id ?></td>
                <td><?= $model->month_year ?></td>
                <td><?= $model->sales_target_amount?></td>
                <td><?= $model->rep->user->name?></td>

                <td>
                    <div class="btn-group" role="group">
                       
                        <?= Html::a('Update', ['update', 'target_id' => $model->target_id], ['class' => 'btn rounded btn-success ms-1']) ?>
                        <?= Html::a('Delete', ['delete', 'target_id' => $model->target_id], ['class' => 'btn rounded btn-success ms-1',
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