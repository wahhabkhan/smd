<?php

use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model common\models\Intervention */

$this->title = 'Intervention';
$this->params['breadcrumbs'][] = ['label' => 'Intervention View', 'url' => ['intervention/view-intervention'],
             'class'=>'text-danger'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
 
  <?php
  $intervetnionModel = $model->intervention_id;
  ?>
      <div class="container" style="margin-left: 180px;">
        

        <div class="col-md-6">
            <div class="intervention-view">
                <div class="container">
                        <h3 class="text-center text-danger my-3"><?= $this->title ?> <?= $intervetnionModel?>
                            <?="Details" ?></h3>
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
                    </div>
                    <div class="row">

                        <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'intervention_id' ,
            'name_of_intervention',
            'short_description' ,
            'giz_module',
            'component_manager' ,
            'comments' 
        ],
    ]) ?>
                    </div>
                </div>
        </div>
       

</body>

</html>