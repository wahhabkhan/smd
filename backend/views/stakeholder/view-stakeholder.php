<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var array $models */

$this->title = 'Stakeholder View';
//$this->params['breadcrumbs'][] = $this->title;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>


    <div class="stakeholder-view ms-5">
        <h4 class="text-center text-danger" style="margin-left: 95px"><?= Html::encode($this->title) ?></h4>
        <table style="margin-left: 95px" class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>
                    Stakeholder Category
                    <?= Html::dropDownList('stakeholder_category', null, $stakeholder, ['class' => 'form-control p-1 w-75 text-center mt-2', 'prompt' => 'Select', 'id' => 'stakeholder-category-select']) ?>
                </th>
                <th class="w-25">Organization Name</th>
                <th class="text-center">Action</th>
            </tr>

            <?php foreach ($models as $model) : ?>
            <tr class="stakeholder-row" data-category="<?= $model->stakeholder_category ?>">
                <!-- Table data cells as before -->
                <td><?= $model->stakeholder_id ?></td>
                <td><?= $model->stakeholder_category ?></td>
                <td><?= $model->organization_name ?></td>
                <td>
                    <div class="btn-group" role="group">
                        <?= Html::a('View', ['stakeholder/view-stakeholder-details', 'stakeholder_id' => $model->stakeholder_id], ['class' => 'btn d-flex align-items-center rounded btn-danger ms-1']) ?>
                        <?= Html::a('Update', ['update', 'stakeholder_id' => $model->stakeholder_id], ['class' => 'btn  d-flex align-items-center rounded  btn-danger ms-1']) ?>
                        <?= Html::a('Delete', ['delete', 'stakeholder_id' => $model->stakeholder_id], ['class' => 'btn  d-flex align-items-center rounded  btn-danger ms-1',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        <?= Html::a('Add Contact', ['contact/add-contact', 'stakeholder_id' => $model->stakeholder_id], ['class' => 'btn  rounded btn-primary ms-1']) ?>
                        <?= Html::a('View Contacts', ['contact/view-contact', 'stakeholder_id' => $model->stakeholder_id], ['class' => 'btn  rounded btn-primary ms-1']) ?>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>


    <script>
    document.getElementById('stakeholder-category-select').addEventListener('change', function() {
        const selectedCategory = this.value;
        const rows = document.querySelectorAll('.stakeholder-row');
        rows.forEach(row => {
            if (selectedCategory === 'select' || row.dataset.category === selectedCategory) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    });
    </script>


</body>

</html>