<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var array $models */

$this->title = 'Intervention View';
//$this->params['breadcrumbs'][] = $this->title;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>


    <div class="intervention-view ms-5">
        <h4 class="text-danger text-center" style="margin-left:95px"><?=Html::encode($this->title)?></h4>

        <table style="margin-left:95px" class="table table-bordered ">
            <tr>
                <th>ID</th>
                <th>Name of Intervention</th>
                <th>component_manager</th>
                <th>Action</th>
            </tr>
            <?php foreach ($models as $model): ?>
            <tr>
                <td><?=$model->intervention_id?></td>
                <td><?=$model->name_of_intervention?></td>
                <td><?=$model->component_manager?></td>
                <td>
                    <div class="btn-group" role="group">
                        <?= Html::a('View', ['intervention/view-intervention-details', 'intervention_id' => $model->intervention_id], ['class' => 'btn  rounded btn-danger ms-1']) ?>
                        <?=Html::a('Update', ['update', 'intervention_id' => $model->intervention_id], ['class' => 'btn rounded btn-danger ms-1'])?>
                        <?=Html::a('Delete', ['delete', 'intervention_id' => $model->intervention_id], [
    'class' => 'btn rounded btn-danger ms-1',
    'data' => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method' => 'post',
    ],
])?>
                    </div>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>

</body>

</html>