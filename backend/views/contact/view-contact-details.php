<?php

use yii\widgets\DetailView;
use yii\widgets\BreadCrumbs;

/* @var $this yii\web\View */
/* @var $model common\models\Contact */

$this->title = 'Contact View';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
<?php
  $stakeModel = $model->stakeholder_id;
  $this->params['breadcrumbs'][] = ['label' => 'Contacts', 'url' => ['contact/view-contact','stakeholder_id' => $stakeModel],
              'class' => 'text-danger'];
  ?>
      <div class="container" style="margin-left: 180px;">
        

        <div class="col-md-6">
            <div class="container-view">
                <div class="container">
                        <h3 class="text-center text-danger my-3"><?= $this->title ?> <?= $stakeModel?> <?="Details" ?>
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
            'id_contacts',
            [
                'attribute' => 'stakeholder_category',
                'value' => $model->stakeholder->stakeholder_category,
            ],
            'contact_category',
            'gender',
            'academic_titles',
            'last_name',
            'first_name',
            'call_name',
            'current_company',
            'designation',
            'previous_company',
            'house_number',
            'street',
            'city',
            'postal_code',
            'extra_info_of_place',
            'country',
            'web_link',
            'geo_data',
            'landline_phone_1',
            'landline_phone_2',
            'fax',
            'cell_phone_1',
            'cell_phone_2',
            'cell_phone_3',
            'cell_phone_4',
            'email_1',
            'email_2',
            'email_3',
            'email_4',
            'whatsapp_1',
            'whatsapp_2',
            'whatsapp_3',
            'whatsapp_4',
        ],
    ]) ?>
                        </div>
                    </div>
                </div>
            </div>


</body>

</html>