<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Stakeholder;
use common\models\Project;
use common\models\Intervention;
use kartik\select2\Select2;

// Rest of your code

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <div class="content">
        <div class="form-container">
            <div class="history-form">

                <?php
        $stakeholders = Stakeholder::find()->all();
        $stakeholderList = ArrayHelper::map($stakeholders, 'stakeholder_id', 'organization_name');

        $projects = Project::find()->all();
        $projectList = ArrayHelper::map($projects, 'project_id', 'name_of_module');

        $interventions = Intervention::find()->all();
        $interventionList = ArrayHelper::map($interventions, 'intervention_id', 'name_of_intervention');

        $years =[
          '2000' => '2000','2001' => '2001','2002' => '2002','2003' => '2003','2004' => '2004','2005' => '2005',
          '2006' => '2006','2007' => '2007','2008' => '2008','2009' => '2009','2010' => '2010','2011' => '2011',
          '2012' => '2012','2013' => '2013','2014' => '2014','2015' => '2015','2016' => '2016','2017' => '2017',
          '2018' => '2018','2019' => '2019','2020' => '2020','2021' => '2021','2022' => '2022','2023' => '2023'  
        ];
      ?>

                <h3 class="text-center text-danger mb-4">Interventions History Form</h3>

                <?php $form = ActiveForm::begin(); ?>

                
               <?= $form->field($model, 'Stakeholders')->widget(Select2::classname(), [
               'data' => $stakeholderList,
               'options' => [
                              'placeholder' => 'Select Stakeholders',
                              'multiple' => true,
               ],
               'pluginOptions' => [
                              'allowClear' => true,
               ],
               'value' => $model->Stakeholders, 
               ]); ?>


                <?= $form->field($model, 'project_id')->dropDownList(
               $projectList,
               ['prompt' => 'Select Project']
               ) ?>
                <?= $form->field($model, 'intervention_id')->dropDownList(
               $interventionList,
               ['prompt' => 'Select Intervention']
               ) ?>

                <?=$form->field($model, 'year_of_intervention')->dropDownList(
                $years,
                ['prompt' => 'Select Year']
                )?>

                <?=$form->field($model, 'giz_intervention')->textInput(['maxlength' => true])?>
                <?=$form->field($model, 'focal_person')->textInput(['maxlength' => true])?>
                <?=$form->field($model, 'comments')->textArea(['maxlength' => true])?>

                <div class="form-group text-center my-4">
                    <?=Html::submitButton('Save', ['class' => 'btn w-25 btn-danger'])?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>


</body>

</html>