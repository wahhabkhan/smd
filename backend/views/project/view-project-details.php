<?php
use yii\widgets\Breadcrumbs;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Project */

$this->title = 'Project';
$this->params['breadcrumbs'][] = ['label' => 'Project View', 'url' => ['view-project'], 'class' => 'text-danger'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>

<?php
  $projectModel = $model->project_id;
  ?>
      <div class="container" style="margin-left: 180px;">
        

            <div class="col-md-6">
                <div class="project-view">
                    <div class="container">
                        <h3 class="text-center text-danger my-3"><?= $this->title ?> <?= $projectModel?> <?="Details" ?> </h3>
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
            'project_id' ,
            'name_of_module' ,
            'short_description',
            // 'giz_intervention' ,
            'duration' ,
            'av' ,
            'budget' ,
            'comments' ,
        ],
    ]) ?>
                    </div>
                </div>
            </div>
    </div>
    


</body>

</html>