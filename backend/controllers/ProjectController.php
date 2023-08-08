<?php

namespace backend\controllers;

use common\models\Project;
use yii\web\Controller;

class ProjectController extends Controller
{
    public function actionViewProject()
    {
        // Fetch all Project
        $models = Project::find()->all();
    
        // Define the variable to control the display of additional columns
       // $showInterventionColumns = true; // Change the value to true or false based on your requirements
    
        return $this->render('view-project', [
            'models' => $models,
        //    'showProjectColumns' => $showProjectColumns, // Pass the variable to the view
        ]);
    }
    
    
    public function actionViewProjectDetails($project_id)
    {
        // Fetch the contact record to ensure it exists
        $model = Project::findOne($project_id);
    
        return $this->render('view-project-details', [
            'model' => $model,
        ]);
    } 

    public function actionAddProject()
    {
        $model = new Project();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view-project', 'project_id' => $model->project_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('add-project', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($project_id)
    {
        $model = $this->findModel($project_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view-project', 'project_id' => $model->project_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($project_id)
    {
        $this->findModel($project_id)->delete();

        return $this->redirect(['/site/index']);
    }

    protected function findModel($project_id)
    {
        if (($model = Project::findOne(['project_id' => $project_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
