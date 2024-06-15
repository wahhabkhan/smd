<?php
use yii\widgets\Breadcrumbs;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Sales Details */

$this->title = 'Sales Details';
$this->params['breadcrumbs'][] = ['label' => 'Sales Details', 'url' => ['view-sales-details'], 'class' => 'text-success'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <?php
  $userModel = $model->rep_id;
  ?>
      <div class="container" style="margin-left: 180px;">
        

        <div class="col-md-6">
            <div class="">
                <div class="container">
                        <h3 class="text-center text-success my-3"><?= $this->title ?> <?= $userModel?> <?="Details" ?>
                        </h3>
                        <?= Breadcrumbs::widget([
        'links' => $this->params['breadcrumbs'],
        'options' => ['class' => 'breadcrumb'],
        'itemTemplate' => '<li class="breadcrumb-item">{link}</li>',
        'homeLink' => [
          'label' => 'Home',
          'url' => Yii::$app->homeUrl,
          'class' => 'text-success', 
      ],
    ]) ?>
                    </div>

                    <div class="row">

                        <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'detail_id' ,
            'quantity_sold' ,
            'sales_id',
            'product_id',
        ],
    ]) ?>
                    </div>
                </div>
            </div>
    </div>


</body>

</html>