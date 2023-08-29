<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var array $models */

$this->title = 'Project View';
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
        <h4 class="text-center text-danger" style="margin-left:95px"><?=Html::encode($this->title)?></h4>

        <table style="margin-left:95px" class="table table-bordered ">
            <tr>
                <th>ID</th>
                <th>Name of Project</th>
                <th>Duration</th>
                <th>AV</th>
                <th>Budget</th>
                <th>Action</th>
            </tr>
            <?php foreach ($models as $model): ?>
            <tr>
                <td><?=$model->project_id?></td>
                <td><?=$model->name_of_module?></td>
                <td><?=$model->duration?></td>
                <td><?=$model->av?></td>
                <td><?=$model->budget?></td>
                <td>
                    <div class="btn-group" role="group">
                        <?= Html::a('View', ['project/view-project-details', 'project_id' => $model->project_id], ['class' => 'btn  rounded btn-danger ms-1']) ?>
                        <?=Html::a('Update', ['update', 'project_id' => $model->project_id], ['class' => 'btn rounded btn-danger ms-1'])?>
                        <?=Html::a('Delete', ['delete', 'project_id' => $model->project_id], [
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