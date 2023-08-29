<?php

use yii\widgets\DetailView;
use yii\widgets\BreadCrumbs;

/* @var $this yii\web\View */
/* @var $model common\models\Stakeholder */

$this->title = 'Stakeholder';
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

<?php
  $stakeholderModel = $model->stakeholder_id;
  ?>
      <div class="container" style="margin-left: 180px;">
        

        <div class="col-md-6">
            <div class="container-view">
                <div class="container">
                        <h3 class="text-center text-danger my-3"><?= $this->title ?> <?= $stakeholderModel?>
                            <?="Details" ?>
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
            'stakeholder_id',
            'stakeholder_category' ,
            'organization_name' ,
            'legal_form' ,
            'stakeholder_cat_specific_info' ,
            'size' ,
            'products',
            'production_capacity',
            'main_markets' ,
            'brands' ,
            'purchasing_capacity' ,
            'main_purchasing_markets' ,
            'main_sales_markets' ,
            'suppling_factories' ,
            'department' ,
            'sub_category',
            'organizational_location',
            'objective' ,
            'main_services' ,
            'membership' ,
            'giz_intervention_history'
        ],
    ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</body>

</html>