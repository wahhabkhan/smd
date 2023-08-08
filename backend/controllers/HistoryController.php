<?php

namespace backend\controllers;

use common\models\History;
use common\models\Stakeholder;
use yii\web\Controller;

class HistoryController extends Controller
{
    public function actionViewHistory()
    {
        // Fetch all History
        $models = History::find()->all();
    
        // Define the variable to control the display of additional columns
       // $showHistoryColumns = true; // Change the value to true or false based on your requirements
    
        return $this->render('view-history', [
            'models' => $models,
        //    'showHistoryColumns' => $showHistoryColumns, // Pass the variable to the view
        ]);
    }
    
    public function actionViewHistoryDetails($intervention_history_id)
    {
        // Fetch the History record to ensure it exists
        $model = History::findOne($intervention_history_id);
    
        return $this->render('view-history-details', [
            'model' => $model,
        ]);
    }
    
    public function actionAddHistory()
    {
        $model = new History();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view-history', 'intervention_history_id' => $model->intervention_history_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('add-history', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($intervention_history_id)
    {
        $model = $this->findModel($intervention_history_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view-history', 'intervention_history_id' => $model->intervention_history_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($intervention_history_id)
    {
        $this->findModel($intervention_history_id)->delete();

        return $this->redirect(['view-history']);
    }

    protected function findModel($intervention_history_id)
    {
        if (($model = History::findOne(['intervention_history_id' => $intervention_history_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
