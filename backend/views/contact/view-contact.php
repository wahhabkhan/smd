<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/** @var yii\web\View $this */
/** @var array $models */

$this->title = 'Contact View';
$this->params['breadcrumbs'][] = ['label' => 'Stakeholder View', 'url' => ['stakeholder/view-stakeholder'],
              'class' => 'text-danger'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="contact-view ms-5">
        <h4 class="text-center text-danger" style="margin-left: 95px"><?= Html::encode($this->title) ?></h4>
        <div class=''>
            <?= Breadcrumbs::widget([
        'links' => $this->params['breadcrumbs'],
        'itemTemplate' => '<li class="breadcrumb-item">{link}</li>',
        'homeLink' => [
          'label' => 'Home',
          'url' => Yii::$app->homeUrl,
          'class' => 'text-danger',
          'style' => 'margin-left: 100px;' 
      ],
    ]) ?>
        </div>
        <table style="margin-left:95px" class="table table-bordered ">
            <tr>
                <th>ID</th>
                <th>Stakeholder</th>
                <th>First Name</th>
                <th>Current Company</th>
                <th>Designation</th>
                <th>Cell Phone 1</th>



                <th>Action</th>
            </tr>
            <?php foreach ($models as $model): ?>
            <tr>
                <td><?=$model->id_contacts?></td>
                <td><?= $model->stakeholder->stakeholder_category ?></td>
                <td><?=$model->first_name?></td>
                <td><?=$model->current_company?></td>
                <td><?=$model->designation?></td>
                <td><?=$model->cell_phone_1?></td>

                <td>
                    <div class="btn-group" role="group">
                        <?= Html::a('View', ['contact/view-contact-details', 'id_contacts' => $model->id_contacts], ['class' => 'btn rounded btn-danger ms-1']) ?>
                        <?= Html::a('Update', ['update', 'id_contacts' => $model->id_contacts], ['class' => 'btn rounded btn-danger ms-1']) ?>
                        <?= Html::a('Delete', ['delete', 'id_contacts' => $model->id_contacts], ['class' => 'btn rounded btn-danger ms-1',
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