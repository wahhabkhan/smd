<?php

use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model common\models\History */

$this->title = 'Intervention History';
$this->params['breadcrumbs'][] = ['label' => 'Intervention History View', 'url' => ['history/view-history'],
              'class' => 'text-danger'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <?php
  $historyModel = $model->intervention_history_id;
  ?>
      <div class="container" style="margin-left: 180px;">
        

        <div class="col-md-6">
            <div class="container-view">
                <div class="container">
                        <h3 class="text-center text-danger my-3"><?= $this->title ?> <?= $historyModel?> <?="Details" ?>
                        </h3>
                        <?= Breadcrumbs::widget([
        'links' => $this->params['breadcrumbs'],
        'options' => ['class' => 'breadcrumb'],
        'itemTemplate' => '<li class="breadcrumb-item">{link}</li>',
        'homeLink' => [
          'label' => 'Home',
          'url' => Yii::$app->homeUrl,
          'class' => 'text-danger', 
      ],
    ]) ?>
                        <div class="row">

                            <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'intervention_history_id' ,
            'year_of_intervention' ,
            'focal_person' ,
            'comments' ,
            [
                'attribute' => 'stakeholder_id',
            'value' => isset($model->stakeholder) ? $model->stakeholder->stakeholder_category : '',
                
            ],
            [
                'attribute' => 'project_id',
                'value' => $model->project->name_of_module,
            ],
            [
                'attribute' => 'intervention_id',
                'value' => $model->intervention->name_of_intervention,
            ], 
        ],
    ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>