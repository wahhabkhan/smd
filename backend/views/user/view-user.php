<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var array $models */

$this->title = 'Users';
//$this->params['breadcrumbs'][] = $this->title;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="user-view ms-5">
        <h4 class="text-center text-success" style="margin-left:10px"><?=Html::encode($this->title)?></h4>

        <table style="margin-left:95px" class="table table-bordered w-75">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
            <?php foreach ($models as $model): ?>
            <tr>
                <td><?=$model->id?></td>
                <td><?=$model->username?></td>
                <td><?=$model->password_hash?></td>
                <td>
                    <div class="btn-group" role="group">
                        <?= Html::a('View', ['user/view-user-details', 'id' => $model->id], ['class' => 'btn  rounded btn-success ms-1']) ?>
                        <?=Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn rounded btn-success ms-1'])?>
                        <?=Html::a('Delete', ['delete', 'id' => $model->id], [
    'class' => 'btn rounded btn-success ms-1',
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