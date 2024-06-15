<?php

use yii\helpers\Html;


/** @var yii\web\View $this */
/** @var array $models */

$this->title = 'Feedback';
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
                <th>Feedback ID</th>
                <th>Rep</th>
                <th>Feedback</th>
                <th>Action</th>
            </tr>
            <?php foreach ($models as $model): ?>
            <tr>
                <td><?= $model->feedback_id ?></td>
                <td><?= $model->rep->user->name?></td>
                <td><?= $model->feedback_text?></td>
                

                <td>
                    <div class="btn-group" role="group">
                       
                        <?= Html::a('Update', ['update', 'feedback_id' => $model->feedback_id], ['class' => 'btn rounded btn-success ms-1']) ?>
                        <?= Html::a('Delete', ['delete', 'feedback_id' => $model->feedback_id], ['class' => 'btn rounded btn-success ms-1',
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